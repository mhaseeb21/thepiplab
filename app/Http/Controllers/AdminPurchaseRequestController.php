<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Purchase;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Mail\PurchaseRequestStatus;

class AdminPurchaseRequestController extends Controller
{
    public function index()
    {
        // ✅ Exclude 'signals' because they are auto-approved via NOWPayments
        $purchaseRequests = Purchase::with('user')
            ->where('product_type', '!=', 'signals')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.purchaseRequest', compact('purchaseRequests'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $purchaseRequest = Purchase::with('user')->findOrFail($id);

        // ✅ Safety: do not allow manual updates for signals
        if ($purchaseRequest->product_type === 'signals') {
            return redirect()->back()->with('error', 'Signals purchases are auto-processed and cannot be updated manually.');
        }

        $newStatus = $request->input('status');

        // If no change, do nothing
        if ($purchaseRequest->status === $newStatus) {
            return redirect()->back()->with('success', 'No changes were made.');
        }

        DB::transaction(function () use ($purchaseRequest, $newStatus) {

            $purchaseRequest->status = $newStatus;
            $purchaseRequest->save();

            // ✅ If approved + product is course => grant signals access for 6 months
            if ($newStatus === 'approved' && $purchaseRequest->product_type === 'course') {
                $this->grantOrExtendSignalsMonths($purchaseRequest->user_id, 6);
            }

            // ✅ Reverse commission ONLY if rejected
            if ($newStatus === 'rejected') {
                $this->reverseCommission($purchaseRequest);
            }
        });

        // ✅ Send email notification (only if user exists)
        if ($purchaseRequest->user && $purchaseRequest->user->email) {
            Mail::to($purchaseRequest->user->email)
                ->send(new PurchaseRequestStatus($purchaseRequest, $newStatus));
        }

        return redirect()->back()->with('success', 'Purchase request updated successfully.');
    }

    /**
     * ✅ Grant/extend signals access for X months (6 months for course bonus)
     * - If user already has active signals -> extend from current expiry
     * - Else create a new approved signals row with expires_at
     */
    private function grantOrExtendSignalsMonths(int $userId, int $months): void
    {
        $now = Carbon::now();

        $latestSignals = Purchase::where('user_id', $userId)
            ->where('product_type', 'signals')
            ->where('status', 'approved')
            ->orderByDesc('expires_at')
            ->first();

        // ✅ Extend existing active subscription
        if ($latestSignals && $latestSignals->expires_at && Carbon::parse($latestSignals->expires_at)->gt($now)) {
            $latestSignals->expires_at = Carbon::parse($latestSignals->expires_at)->addMonthsNoOverflow($months);
            $latestSignals->save();
            return;
        }

        // ✅ Otherwise create new subscription starting now
        Purchase::create([
            'user_id'        => $userId,
            'transaction_id' => 'BONUS-COURSE-' . $now->format('YmdHis'),
            'product_type'   => 'signals',
            'amount'         => 0,
            'payment_proof'  => null, // ✅ ensure purchases.payment_proof is nullable for bonus entries
            'status'         => 'approved',
            'expires_at'     => $now->copy()->addMonthsNoOverflow($months),
        ]);
    }

    private function reverseCommission(Purchase $purchaseRequest): void
    {
        $referrerId = $purchaseRequest->user?->referred_by;

        if (!$referrerId) {
            return;
        }

        // Find the commission transaction that was logged for this purchase
        $commissionTransaction = WalletTransaction::where('purchase_id', $purchaseRequest->id)
            ->where('user_id', $referrerId)
            ->first();

        if (!$commissionTransaction) {
            return;
        }

        // Reverse the commission by subtracting it from the referrer's wallet
        $referrerWallet = Wallet::where('user_id', $referrerId)->first();

        if ($referrerWallet) {
            $referrerWallet->balance = max(0, $referrerWallet->balance - $commissionTransaction->amount);
            $referrerWallet->save();
        }

        // Delete the commission transaction
        $commissionTransaction->delete();
    }

    public function activeSignalsSubscribers()
    {
        $subscribers = Purchase::with('user')
            ->where('product_type', 'signals')
            ->where('status', 'approved')
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', Carbon::now())
            ->orderByDesc('expires_at')
            ->get();

        return view('admin.activeSignalsSubscribers', compact('subscribers'));
    }
}
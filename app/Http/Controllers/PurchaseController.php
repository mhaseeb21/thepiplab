<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // Show the purchase page:
    // - signals: shows subscribe button (automated)
    // - course: shows manual payment form
    // - bot: DISABLED here (bot is via quote flow)
    public function create($product)
    {
        $amount = 0;

        switch ($product) {
            case 'signals':
                $amount = (float) env('SIGNAL_PLAN_PRICE', 15); // automated price
                break;

            case 'course':
                $amount = 200;
                break;

            case 'bot':
                // ✅ Bot purchase is no longer direct
                // Redirect user to bot request form
                return redirect()->route('bot.request.create')
                    ->withErrors(['error' => 'Bots are custom. Please submit a Bot Request to receive a quote.']);

            default:
                abort(404);
        }

        return view('client.purchase', compact('product', 'amount'));
    }

    // Store manual purchases ONLY (course)
    public function store(Request $request)
    {
        // ✅ Block signals + bot manual purchase submissions
        if ($request->product_type === 'signals') {
            return redirect()->back()->withErrors([
                'error' => 'Signals subscription is automated. Please use the Subscribe button.'
            ]);
        }

        if ($request->product_type === 'bot') {
            return redirect()->back()->withErrors([
                'error' => 'Bots are custom. Please submit a Bot Request to receive a quote.'
            ]);
        }

        // ✅ Manual purchases allowed ONLY for course now
        $request->validate([
            'transaction_id' => 'required|string|max:255',
            'payment_proof'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_type'   => 'required|in:course',
            'amount'         => 'required|numeric|min:1',
        ]);

        // Handle image upload
        $imagePath = $request->file('payment_proof')->store('payments', 'public');

        // Create the purchase (manual approval)
        $purchase = Purchase::create([
            'user_id'        => Auth::id(),
            'bot_request_id' => null, // ✅ course not linked to bot request
            'transaction_id' => $request->transaction_id,
            'product_type'   => 'course',
            'amount'         => $request->amount,
            'payment_proof'  => $imagePath,
            'status'         => 'pending',
            'expires_at'     => null, // course no expiry
        ]);

        // ✅ Referral commission (ONLY for course)
        $referrerId = Auth::user()->referred_by;
        $referrer = $referrerId ? User::find($referrerId) : null;

        if ($referrer) {
            $commission = $request->amount * 0.20;

            $wallet = Wallet::firstOrCreate(['user_id' => $referrer->id]);
            $wallet->balance += $commission;
            $wallet->save();

            WalletTransaction::create([
                'user_id'     => $referrer->id,
                'referral_id' => Auth::id(),
                'purchase_id' => $purchase->id,
                'amount'      => $commission,
            ]);
        }

        return redirect()->back()->with('success', 'Your purchase has been submitted and is pending approval.');
    }
}

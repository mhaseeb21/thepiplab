<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NowPaymentsController extends Controller
{
    /**
     * Create a NOWPayments payment for SIGNALS subscription (auto flow).
     * Redirect user to NOWPayments hosted page.
     */
   public function createSignalPayment(Request $request)
{
    $user = $request->user();

    $active = Purchase::where('user_id', $user->id)
        ->where('product_type', 'signals')
        ->where('status', 'approved')
        ->where('expires_at', '>', now())
        ->exists();

    if ($active) {
        return back()->withErrors(['error' => 'You already have an active subscription.']);
    }

    $orderId = 'signal_' . $user->id . '_' . time();

    // ✅ Use INVOICE endpoint (returns invoice_url)
    $payload = [
        "price_amount"      => (float) env('SIGNAL_PLAN_PRICE', 15),
        "price_currency"    => env('NOWPAYMENTS_PRICE_CURRENCY', 'usd'),
        "pay_currency"      => env('NOWPAYMENTS_PAY_CURRENCY', 'usdttrc20'),
        "order_id"          => $orderId,
        "order_description" => "Daily Market Updates Subscription",
        // invoice endpoint uses "ipn_callback_url" too
        "ipn_callback_url"  => env('NOWPAYMENTS_IPN_URL'),
        "success_url"       => route('subscribe.success'),
        "cancel_url"        => route('subscribe.cancel'),
    ];

    $res = Http::withHeaders([
        'x-api-key' => env('NOWPAYMENTS_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://api.nowpayments.io/v1/invoice', $payload);

    $data = $res->json();

    \Log::info('NOWPayments create invoice response', [
        'status' => $res->status(),
        'body'   => $data,
    ]);

    if (!$res->successful()) {
        return back()->withErrors(['error' => 'Payment gateway error. Please try again.']);
    }

    // ✅ Create pending purchase
    Purchase::create([
        'user_id'        => $user->id,
        'product_type'   => 'signals',
        'amount'         => $payload['price_amount'],
        'status'         => 'pending',
        'expires_at'     => null,
        'provider'       => 'nowpayments',
        'payment_id'     => $data['payment_id'] ?? null,   // sometimes present
        'transaction_id' => $orderId,                      // store order id
        'payload'        => $data,
    ]);

    $url = $data['invoice_url'] ?? null;

    if (!$url) {
        \Log::error('NOWPayments invoice_url missing', ['body' => $data]);
        return back()->withErrors(['error' => 'Invoice created but no invoice_url returned. Check logs.']);
    }

    return redirect()->away($url);
}

    /**
     * NOWPayments IPN webhook endpoint.
     * Verifies signature, updates purchase status, activates subscription, pays referral commission once.
     */
  public function ipn(Request $request)
{
    // 1) Verify signature (mandatory)
    $receivedSig = $request->header('x-nowpayments-sig');
    $secret = env('NOWPAYMENTS_IPN_SECRET');
    $rawBody = $request->getContent();

    $calculatedSig = hash_hmac('sha512', $rawBody, $secret);

    if (!$receivedSig || !hash_equals($calculatedSig, $receivedSig)) {
        return response('Invalid signature', 401);
    }

    $data = $request->all();

    $paymentId = $data['payment_id'] ?? null;
    $status    = $data['payment_status'] ?? null;

    if (!$paymentId) {
        return response('Missing payment_id', 400);
    }

    // 2) Find the purchase made for this NOWPayments payment
    $purchase = Purchase::where('provider', 'nowpayments')
        ->where('payment_id', $paymentId)
        ->latest()
        ->first();

    if (!$purchase) {
        return response('Purchase not found', 404);
    }

    // Always store latest payload
    $purchase->payload = $data;

    // 3) Auto-approve when payment is actually confirmed/finished
    $goodStatuses = ['confirmed', 'finished'];

    if (in_array($status, $goodStatuses, true)) {

        // ✅ If already approved, do nothing (idempotent)
        if ($purchase->status !== 'approved') {
            $purchase->status = 'approved';

            // ✅ Extend subscription from NOW if expired, else extend from current expiry
            $base = ($purchase->expires_at && $purchase->expires_at->isFuture())
                ? $purchase->expires_at
                : now();

            $purchase->expires_at = $base->copy()->addDays(30);
        }

    } elseif (in_array($status, ['failed', 'expired'], true)) {
        // Auto-reject
        $purchase->status = 'rejected';
    }

    $purchase->save();

    return response('OK', 200);
}
}
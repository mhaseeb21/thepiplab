<?php

namespace App\Http\Controllers;

use App\Models\BotRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BotRequestController extends Controller
{
    public function create()
    {
        return view('client.bot_request_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bot_type'       => 'required|string|max:100',
            'platform'       => 'required|string|max:100',
            'market'         => 'required|string|max:100',
            'risk_profile'   => 'required|string|max:50',
            'timeframe'      => 'nullable|string|max:50',
            'budget_range'   => 'nullable|string|max:100',
            'contact'        => 'nullable|string|max:100',
            'strategy_notes' => 'nullable|string|max:5000',
        ]);

        BotRequest::create([
            'user_id'        => Auth::id(),
            'bot_type'       => $request->bot_type,
            'platform'       => $request->platform,
            'market'         => $request->market,
            'risk_profile'   => $request->risk_profile,
            'timeframe'      => $request->timeframe,
            'budget_range'   => $request->budget_range,
            'contact'        => $request->contact,
            'strategy_notes' => $request->strategy_notes,
            'status'         => 'new',
        ]);

        return redirect()->route('bot.request.my')
            ->with('success', 'Your bot request has been submitted. We’ll send you a quote soon.');
    }

    public function myRequests()
    {
        $requests = BotRequest::where('user_id', Auth::id())->latest()->get();
        return view('client.my_bot_requests', compact('requests'));
    }

public function acceptQuote($id)
{
    $botRequest = BotRequest::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    if ($botRequest->status !== 'quoted') {
        return back()->withErrors(['error' => 'This request is not quoted yet.']);
    }

    if (empty($botRequest->quoted_amount) || $botRequest->quoted_amount <= 0) {
        return back()->withErrors(['error' => 'Quote amount is missing. Please wait for admin quote.']);
    }

    $botRequest->status = 'accepted';
    $botRequest->save();

    return redirect()->route('bot.request.payment.form', $botRequest->id)
        ->with('success', 'Quote accepted. Please submit payment proof to proceed.');
}
public function paymentForm($id)
{
    $botRequest = BotRequest::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    if ($botRequest->status !== 'accepted') {
        return redirect()->route('bot.request.my')->withErrors([
            'error' => 'Please accept the quote first.'
        ]);
    }

    if (empty($botRequest->quoted_amount) || $botRequest->quoted_amount <= 0) {
        return redirect()->route('bot.request.my')->withErrors([
            'error' => 'Quote amount is not available yet.'
        ]);
    }

    $hasPendingPayment = Purchase::where('user_id', Auth::id())
        ->where('product_type', 'bot')
        ->where('bot_request_id', $botRequest->id)
        ->where('status', 'pending')
        ->exists();

    return view('client.bot_payment', compact('botRequest', 'hasPendingPayment'));
}


    public function submitPayment(Request $request, $id)
    {
        $botRequest = BotRequest::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($botRequest->status !== 'accepted') {
            return back()->withErrors(['error' => 'Payment can only be submitted after accepting the quote.']);
        }

        if (!$botRequest->quoted_amount) {
            return back()->withErrors(['error' => 'No quote amount found for this request.']);
        }

        $request->validate([
            'transaction_id' => 'required|string|max:255',
            'payment_proof'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('payment_proof')->store('payments', 'public');

        Purchase::create([
            'user_id'        => Auth::id(),
            'bot_request_id' => $botRequest->id,
            'transaction_id' => $request->transaction_id,
            'product_type'   => 'bot',
            'amount'         => $botRequest->quoted_amount,
            'payment_proof'  => $imagePath,
            'status'         => 'pending',
            'expires_at'     => null,
        ]);

        return redirect()->route('bot.request.my')
            ->with('success', 'Payment submitted. Your request is now pending admin approval.');
    }
}

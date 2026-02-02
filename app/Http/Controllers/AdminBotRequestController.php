<?php

namespace App\Http\Controllers;

use App\Models\BotRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Mail\BotQuoteMail;

class AdminBotRequestController extends Controller
{
    public function index()
    {
        $requests = BotRequest::with('user')->orderByDesc('created_at')->get();
        return view('admin.bot_requests', compact('requests'));
    }

   public function sendQuote(Request $request, $id)
{
    $request->validate([
        'quoted_amount' => 'required|numeric|min:1',
        'quote_message' => 'required|string|max:5000',
    ]);

    $botRequest = BotRequest::with('user')->findOrFail($id);

    $botRequest->update([
        'quoted_amount' => $request->quoted_amount,
        'quote_message' => $request->quote_message,
        'status'        => 'quoted',
        'quote_sent_at' => now(),
    ]);

    if ($botRequest->user?->email) {
        Mail::to($botRequest->user->email)->send(new \App\Mail\BotQuoteMail($botRequest));
    }

    return redirect()->back()->with('success', 'Quote sent successfully.');
}


    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,quoted,accepted,rejected,in_progress,delivered',
        ]);

        $botRequest = BotRequest::findOrFail($id);
        $botRequest->status = $request->status;
        $botRequest->save();

        return back()->with('success', 'Bot request status updated.');
    }
}

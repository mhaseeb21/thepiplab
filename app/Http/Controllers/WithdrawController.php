<?php

namespace App\Http\Controllers;

use App\Models\WithdrawRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    // Show the withdrawal form
    public function create()
    {
        $user = Auth::user();

        // Get the user's wallet or create a new one if it doesn't exist
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $user->id], // Check if wallet exists for this user
            ['balance' => 0] // If not, create it with a balance of 0
        );
    
        return view('client.withdraw', compact('wallet'));
    }

    // Handle the withdrawal request
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10', // Minimum withdrawal amount
            'withdraw_type' => 'required|string', // Make withdraw_type mandatory
            'withdraw_address' => 'required|string', // Make withdraw_address mandatory
        ]);
    
        $user = Auth::user();
        $wallet = $user->wallet;
    
        // Check if the user has sufficient balance
        if ($wallet->balance < $request->amount) {
            return redirect()->back()->withErrors(['error' => 'Insufficient balance.']);
        }
    
        // Deduct amount from wallet and save
        $wallet->balance -= $request->amount;
        $wallet->save();
    
        // Create a new withdrawal request
        WithdrawRequest::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'withdraw_type' => $request->withdraw_type, // Include the withdraw_type
            'withdraw_address' => $request->withdraw_address, // Include the withdraw_address
            'status' => 'pending',
        ]);
    
        return redirect()->route('client.withdraw.history')->with('success', 'Withdrawal request submitted.');
    }

    // Show the withdrawal history
    public function history()
    {
        $withdrawals = WithdrawRequest::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('client.withdraw_history', compact('withdrawals'));
    }


    // Admin view for pending withdrawal requests
    public function adminIndex()
    {
        $withdrawRequests = WithdrawRequest::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        return view('admin.withdraw_requests', compact('withdrawRequests'));
    }

    // Approve a withdrawal request
    public function approve($id)
    {
        $withdrawRequest = WithdrawRequest::findOrFail($id);
        $withdrawRequest->status = 'approved';
        $withdrawRequest->save();

        return redirect()->route('admin.withdraw.requests')->with('success', 'Withdrawal request approved.');
    }

    // Reject a withdrawal request
    public function reject($id)
    {
        $withdrawRequest = WithdrawRequest::findOrFail($id);

    // Check if the request is already rejected to prevent double crediting
    if ($withdrawRequest->status !== 'pending') {
        return redirect()->route('admin.withdraw.requests')->withErrors(['error' => 'This request has already been processed.']);
    }

    // Update the status to "rejected"
    $withdrawRequest->status = 'rejected';
    $withdrawRequest->save();

    // Add the amount back to the user's wallet
    $wallet = Wallet::where('user_id', $withdrawRequest->user_id)->first();
    if ($wallet) {
        $wallet->balance += $withdrawRequest->amount;
        $wallet->save();
    }

    return redirect()->route('admin.withdraw.requests')->with('success', 'Withdrawal request rejected, and amount returned to user wallet.');
    }


}

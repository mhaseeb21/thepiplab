<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class ReferralController extends Controller
{
    public function referralDashboard(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();


        // Get the user's wallet or create a new one if it doesn't exist
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $user->id], // Check if wallet exists for this user
            ['balance' => 0] // If not, create it with a balance of 0
        );

        // Check if the user has IB status
        if ($user->ib_status) {
            // Fetch the user's referrals
            $referrals = User::where('referred_by', $user->id)->get();

            // Fetch purchases made by the referrals
            $referralPurchases = Purchase::whereIn('user_id', $referrals->pluck('id'))
                                        ->where('status', 'approved')
                                        ->get();

            // Calculate total earnings from wallet transactions
            $totalEarnings = WalletTransaction::where('user_id', $user->id)->sum('amount');

            // Return view with referrals, referral purchases, and wallet balance
            return view('client.referrals', compact('referrals', 'referralPurchases', 'totalEarnings','wallet'));
        } else {
            // If IB status is false, show the 'Become a Partner' page
            return view('client.become_partner');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Purchase;
use App\Models\Signal;
use App\Models\Affiliate;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // -----------------------
        // USERS
        // -----------------------
        $totalUsers = User::count();
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $partners = User::where('ib_status', true)->count();

        // -----------------------
        // PURCHASES (manual only: course + bot)
        // -----------------------
        $manualPurchasesTotal = Purchase::whereIn('product_type', ['course', 'bot'])->count();
        $manualPurchasesPending = Purchase::whereIn('product_type', ['course', 'bot'])->where('status', 'pending')->count();
        $manualPurchasesApproved = Purchase::whereIn('product_type', ['course', 'bot'])->where('status', 'approved')->count();
        $manualPurchasesRejected = Purchase::whereIn('product_type', ['course', 'bot'])->where('status', 'rejected')->count();

        // Breakdown by type
        $manualCoursePending = Purchase::where('product_type', 'course')->where('status', 'pending')->count();
        $manualBotPending = Purchase::where('product_type', 'bot')->where('status', 'pending')->count();

        // -----------------------
        // SIGNALS SUBSCRIPTIONS (auto + bonus)
        // product_type = signals, status=approved, expires_at
        // -----------------------
        $activeSignalsSubscribers = Purchase::where('product_type', 'signals')
            ->where('status', 'approved')
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', $now)
            ->count();

        $signalsExpiringSoon = Purchase::where('product_type', 'signals')
            ->where('status', 'approved')
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [$now, $now->copy()->addDays(3)])
            ->count();

        $expiredSignals = Purchase::where('product_type', 'signals')
            ->where('status', 'approved')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', $now)
            ->count();

        // -----------------------
        // SIGNALS CONTENT (admin uploads)
        // -----------------------
        $totalSignals = Signal::count();
        $pendingSignals = Signal::where('result_status', 'pending')->count();
        $completedSignals = Signal::where('result_status', '!=', 'pending')->count();

        // -----------------------
        // WITHDRAW REQUESTS
        // -----------------------
        $pendingWithdrawals = WithdrawRequest::where('status', 'pending')->count();
        $pendingWithdrawalsAmount = (float) WithdrawRequest::where('status', 'pending')->sum('amount');

        // -----------------------
        // AFFILIATE / PARTNERSHIP INQUIRIES (PUBLIC LEADS)
        // -----------------------
        $affiliateInquiriesTotal = Affiliate::count();
        $affiliateInquiriesContacted = Affiliate::where('is_contacted', true)->count();
        $affiliateInquiriesUncontacted = Affiliate::where(function ($q) {
            $q->whereNull('is_contacted')->orWhere('is_contacted', false);
        })->count();

        // -----------------------
        // RECENT ACTIVITY (optional but super useful)
        // -----------------------
        $recentManualPurchases = Purchase::with('user')
            ->whereIn('product_type', ['course', 'bot'])
            ->latest()
            ->take(6)
            ->get();

        $recentWithdrawals = WithdrawRequest::latest()->take(6)->get();

        $recentInquiries = Affiliate::latest()->take(6)->get();

        // Pack stats for your existing blade usage: $stats['users'], etc.
        $stats = [
            'users' => $totalUsers,
            'verified_users' => $verifiedUsers,
            'partners' => $partners,

            'manual_purchases_total' => $manualPurchasesTotal,
            'manual_purchases_pending' => $manualPurchasesPending,
            'manual_purchases_approved' => $manualPurchasesApproved,
            'manual_purchases_rejected' => $manualPurchasesRejected,
            'manual_course_pending' => $manualCoursePending,
            'manual_bot_pending' => $manualBotPending,

            'active_signals_subscribers' => $activeSignalsSubscribers,
            'signals_expiring_soon' => $signalsExpiringSoon,
            'signals_expired' => $expiredSignals,

            'signals' => $totalSignals,
            'signals_pending' => $pendingSignals,
            'signals_completed' => $completedSignals,

            'pending_withdrawals' => $pendingWithdrawals,
            'pending_withdrawals_amount' => $pendingWithdrawalsAmount,

            'affiliate_inquiries_total' => $affiliateInquiriesTotal,
            'affiliate_inquiries_contacted' => $affiliateInquiriesContacted,
            'affiliate_inquiries_uncontacted' => $affiliateInquiriesUncontacted,
        ];

        return view('admin.dashboard', compact(
            'stats',
            'recentManualPurchases',
            'recentWithdrawals',
            'recentInquiries'
        ));
    }
}

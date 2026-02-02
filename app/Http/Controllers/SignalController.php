<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;
use App\Models\Purchase;
use Illuminate\Support\Carbon;

class SignalController extends Controller
{
    /**
     * ✅ Only allow Signals page if user has an ACTIVE Signals subscription
     * (approved + expires_at in future)
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // ✅ Signals access check (AUTO subscription)
        $hasActiveSignals = Purchase::where('user_id', $user->id)
            ->where('product_type', 'signals')
            ->where('status', 'approved')
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', Carbon::now())
            ->exists();

        if (!$hasActiveSignals) {
            // Redirect to your subscribe/purchase page for signals
            return redirect()
                ->route('purchase.create', ['product' => 'signals'])
                ->with('error', 'You need an active Signals subscription to access this page.');
        }

        // Pagination size
        $perPage = 12;

        // TAB 1: Pending signals (latest first)
        $pendingSignals = Signal::where('result_status', 'pending')
            ->orderByDesc('created_at')
            ->paginate($perPage, ['*'], 'pending_page')
            ->withQueryString();

        // TAB 2: Completed signals (anything except pending) (latest updated first)
        $completedSignals = Signal::where('result_status', '!=', 'pending')
            ->orderByDesc('updated_at')
            ->paginate($perPage, ['*'], 'completed_page')
            ->withQueryString();

        // Counts for badges
        $pendingCount = Signal::where('result_status', 'pending')->count();
        $completedCount = Signal::where('result_status', '!=', 'pending')->count();

        return view('client.signal', compact(
            'pendingSignals',
            'completedSignals',
            'pendingCount',
            'completedCount'
        ));
    }

    // Keep purchase prompt if you still use it elsewhere
    public function purchasePrompt()
    {
        return view('client.purchase_prompt');
    }

    /**
     * ✅ Also protect Signal detail page
     */
    public function show(Request $request, Signal $signal)
    {
        $user = $request->user();

        $hasActiveSignals = Purchase::where('user_id', $user->id)
            ->where('product_type', 'signals')
            ->where('status', 'approved')
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', Carbon::now())
            ->exists();

        if (!$hasActiveSignals) {
            return redirect()
                ->route('purchase.create', ['product' => 'signals'])
                ->with('error', 'You need an active Signals subscription to view signal details.');
        }

        return view('client.signal_show', compact('signal'));
    }
}
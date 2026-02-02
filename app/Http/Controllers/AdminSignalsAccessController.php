<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSignalsAccessController extends Controller
{
    /**
     * Admin page: list/search clients
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $users = User::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('id', $q);
                });
            })
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.signalsAccess', compact('users', 'q'));
    }

    /**
     * Admin action: grant 30 days signals access to selected user
     */
    public function grant(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'days'    => 'nullable|integer|min:1|max:365',
        ]);

        $userId = (int) $request->user_id;
        $days   = (int) ($request->days ?? 30);

        DB::transaction(function () use ($userId, $days) {
            $this->grantOrExtendSignalsDays($userId, $days);
        });

        return redirect()->back()->with('success', "Signals access granted for {$days} days.");
    }

    /**
     * ✅ Grant/extend signals access for X days (admin complimentary access)
     * - If active signals exist -> extend from current expiry
     * - Else create a new approved signals purchase row
     */
    private function grantOrExtendSignalsDays(int $userId, int $days): void
    {
        $now = Carbon::now();

        $latestSignals = Purchase::where('user_id', $userId)
            ->where('product_type', 'signals')
            ->where('status', 'approved')
            ->orderByDesc('expires_at')
            ->first();

        // Extend existing active subscription
        if ($latestSignals && $latestSignals->expires_at && Carbon::parse($latestSignals->expires_at)->gt($now)) {
            $latestSignals->expires_at = Carbon::parse($latestSignals->expires_at)->addDays($days);
            $latestSignals->save();
            return;
        }

        // Otherwise create a new subscription starting now
        Purchase::create([
            'user_id'        => $userId,
            'transaction_id' => 'ADMIN-GRANT-' . $now->format('YmdHis') . '-' . $userId,
            'product_type'   => 'signals',
            'amount'         => 0,
            'payment_proof'  => null,
            'status'         => 'approved',
            'expires_at'     => $now->copy()->addDays($days),

            // if you have these columns from your later migration:
            'provider'       => 'admin',
            'payment_id'     => null,
            'payload'        => json_encode(['granted_by' => 'admin', 'days' => $days]),
        ]);
    }
}

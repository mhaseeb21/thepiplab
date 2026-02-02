<?php

namespace App\Http\Controllers;

use App\Models\PartnerRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminPartnerRequestController extends Controller
{
    public function index()
    {
        $requests = PartnerRequest::with('user')
            ->latest()
            ->get();

        return view('admin.partnerRequests', compact('requests'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $partner = PartnerRequest::with('user')->findOrFail($id);

        $partner->update([
            'status'      => $request->status,
            'reviewed_at' => Carbon::now(),
        ]);

        // ✅ IMPORTANT: update IB / Partner status
        if ($request->status === 'approved') {
            $partner->user->update([
                'ib_status' => true,
            ]);
        }

        return back()->with('success', 'Partner request updated successfully.');
    }
}

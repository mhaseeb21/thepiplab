<?php

namespace App\Http\Controllers;

use App\Models\PartnerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function create()
    {
        $existing = PartnerRequest::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        return view('client.partner.apply', compact('existing'));
    }

    public function store(Request $request)
    {
        if (PartnerRequest::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved'])
            ->exists()) {
            return back()->with('error', 'You already have an active or pending partner request.');
        }

        $request->validate([
            'team_size'         => 'nullable|integer|min:1',
            'experience'        => 'nullable|string|max:255',
            'promotion_method'  => 'nullable|string|max:255',
            'message'           => 'nullable|string|max:2000',
        ]);

        PartnerRequest::create([
            'user_id'          => Auth::id(),
            'team_size'        => $request->team_size,
            'experience'       => $request->experience,
            'promotion_method' => $request->promotion_method,
            'message'          => $request->message,
        ]);

        return redirect()->back()->with('success', 'Partner application submitted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'contact_number' => 'required|string|max:20',
            'team_members' => 'required|integer|min:1',
            'description' => 'required|string|max:5000',
        ]);

        Affiliate::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'team_members' => $request->team_members,
            'description' => $request->description,

            // Optional (only if you added columns)
            'is_contacted' => false,
            'contacted_at' => null,
        ]);

        return redirect()->back()->with('success', 'Thanks! Your partnership inquiry has been submitted. Our team will contact you soon.');
    }
}

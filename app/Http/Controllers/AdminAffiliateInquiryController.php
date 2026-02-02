<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Http\Request;

class AdminAffiliateInquiryController extends Controller
{
    public function index()
    {
        $inquiries = Affiliate::orderByDesc('created_at')->get();
        return view('admin.affiliateInquiries', compact('inquiries'));
    }

    // Optional: mark as contacted
    public function markContacted($id)
    {
        $inquiry = Affiliate::findOrFail($id);

        // Only if columns exist
        $inquiry->is_contacted = true;
        $inquiry->contacted_at = now();
        $inquiry->save();

        return back()->with('success', 'Marked as contacted.');
    }
}

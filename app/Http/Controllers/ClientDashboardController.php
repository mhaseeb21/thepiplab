<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Purchase;

use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Fetch purchases made by the user
        $purchases = Purchase::where('user_id', $user->id)->where('status', 'approved')->get();

        // Return view with user details and purchases
        return view('client.dashboard', compact('user', 'purchases'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ShowTeamController extends Controller
{
    public function index($id)
    {
        // Find the user by ID and load their referrals
        $user = User::with('referrals')->findOrFail($id);

        // Pass the user and their referrals to the view
        return view('client.team', compact('user'));
    }
}

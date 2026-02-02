<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientPortalController extends Controller
{
    public function index()
    {
        // Logic for the client portal dashboard
        return view('client.portal'); // Assumes there is a view named 'client.portal'
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Signal;

class IndexController extends Controller
{
    public function index()
    {
        $totalClients = User::count() + 115;
        $totalSignals = Signal::count();

        return view('index',compact('totalClients', 'totalSignals')); // Loads the index.blade.php view
    }
}

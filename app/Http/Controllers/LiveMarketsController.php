<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveMarketsController extends Controller
{
    public function index()
    {
        return view('liveMarkets');
    }
}

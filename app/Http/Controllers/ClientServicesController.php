<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientServicesController extends Controller
{
    public function index()
    {
        return view('client.services'); // Loads the index.blade.php view
    }
}

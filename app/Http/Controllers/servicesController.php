<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class servicesController extends Controller
{
    public function index()
    {
        return view('mservices'); // Loads the index.blade.php view
    }
}

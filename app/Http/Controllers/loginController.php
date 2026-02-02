<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class loginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            // Basic validation (no error details exposed)
            if (!$request->filled('email') || !$request->filled('password')) {
                return back()
                    ->withInput($request->only('email'))
                    ->with('error', 'Please enter both email and password.');
            }

            // Attempt login
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $request->session()->regenerate();
                return redirect()->route('client.dashboard');
            }

            // ❌ Wrong credentials (generic message)
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Your email or password is incorrect.');

        } catch (\Throwable $e) {
            // 🔒 Log real error, hide from user
            Log::error('Login error', [
                'message' => $e->getMessage(),
            ]);

            return back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('client.login');
    }
}
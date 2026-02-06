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
            // ✅ Validate inputs properly (+ turnstile token)
            $request->validate([
                'email'                 => 'required|email',
                'password'              => 'required|string',
                'cf-turnstile-response' => 'required|string',
            ]);

            // Attempt login
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {

                $request->session()->regenerate();

                // ✅ If not verified, send to verification notice
                if (Auth::user() && !Auth::user()->hasVerifiedEmail()) {
                    return redirect()->route('verification.notice');
                }

                return redirect()->route('client.dashboard');
            }

            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Your email or password is incorrect.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;

        } catch (\Throwable $e) {
            Log::error('Login error', [
                'message' => $e->getMessage(),
            ]);

            return back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.login');
    }
}

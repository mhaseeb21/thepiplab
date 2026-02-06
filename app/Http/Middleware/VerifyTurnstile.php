<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifyTurnstile
{
    public function handle(Request $request, Closure $next)
    {
        // If token missing
        if (!$request->filled('cf_turnstile_response')) {
            return back()->withInput()->withErrors([
                'cf_turnstile_response' => 'Please complete the verification.'
            ]);
        }

        $verify = Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret'   => config('services.turnstile.secret'),
                'response' => $request->input('cf_turnstile_response'),
                'remoteip' => $request->ip(),
            ]
        )->json();

        if (empty($verify['success'])) {
            return back()->withInput()->withErrors([
                'cf_turnstile_response' => 'Verification failed. Please try again.'
            ]);
        }

        return $next($request);
    }
}

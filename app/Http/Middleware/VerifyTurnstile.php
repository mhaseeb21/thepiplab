<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifyTurnstile
{
    public function handle(Request $request, Closure $next)
    {
        // ✅ allow local development without turnstile
        if (app()->environment('local')) {
            return $next($request);
        }

        $token = $request->input('cf-turnstile-response');

        if (!$token) {
            return back()
                ->withInput()
                ->withErrors(['cf-turnstile-response' => 'Please complete the verification.']);
        }

        $secret = config('services.turnstile.secret');

        if (!$secret) {
            return back()
                ->withInput()
                ->withErrors(['cf-turnstile-response' => 'Turnstile secret key is missing on server.']);
        }

        $response = Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret'   => $secret,
                'response' => $token,
                'remoteip' => $request->ip(),
            ]
        );

        $data = $response->json();

        if (!($data['success'] ?? false)) {
            return back()
                ->withInput()
                ->withErrors(['cf-turnstile-response' => 'Verification failed. Please try again.']);
        }

        return $next($request);
    }
}

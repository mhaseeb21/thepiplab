<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ✅ Keep Bootstrap pagination
        Paginator::useBootstrapFive();

        /*
        |--------------------------------------------------------------------------
        | Rate Limiters (Laravel 11 way)
        |--------------------------------------------------------------------------
        */

        // 🛡️ SIGNUP protection
        RateLimiter::for('signup', function (Request $request) {
            return [
                // Per IP (blocks floods)
                Limit::perMinute(6)->by('signup-ip-'.$request->ip()),

                // Per email (blocks IP rotation attacks)
                Limit::perMinute(2)->by(
                    'signup-email-'.strtolower((string) $request->input('email'))
                ),
            ];
        });

        // 🛡️ LOGIN protection (brute-force / credential stuffing)
        RateLimiter::for('login', function (Request $request) {
            return [
                Limit::perMinute(10)->by('login-ip-'.$request->ip()),
                Limit::perMinute(5)->by(
                    'login-email-'.strtolower((string) $request->input('email'))
                ),
            ];
        });

        // 🛡️ FORGOT PASSWORD (email spam protection)
        RateLimiter::for('forgot-password', function (Request $request) {
            return [
                Limit::perMinute(5)->by('forgot-ip-'.$request->ip()),
                Limit::perMinute(2)->by(
                    'forgot-email-'.strtolower((string) $request->input('email'))
                ),
            ];
        });
    }
}

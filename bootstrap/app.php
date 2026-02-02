<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'admin.guest' => \App\Http\Middleware\AdminRedirect::class,
            'admin.auth'  => \App\Http\Middleware\AdminAuthenticate::class,
            'verified'    => EnsureEmailIsVerified::class,
             'student.course' => \App\Http\Middleware\EnsureCourseEnrolled::class,
        ]);

        // ✅ Make redirect smart (admin vs client)
        $middleware->redirectTo(function ($request) {

            // If user is trying to access admin area, send to admin login
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            // Otherwise send to client login
            return route('client.login');
        });

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

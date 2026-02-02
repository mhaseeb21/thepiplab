<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Purchase;

class EnsureCourseEnrolled
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('client.login');
        }

        $hasActiveCourse = Purchase::where('user_id', $user->id)
            ->where('product_type', 'course')
            ->where('status', 'approved')
            ->exists();

        if (!$hasActiveCourse) {
            return redirect()->route('client.portal')->with('error', 'You do not have access to the student area.');
        }

        return $next($request);
    }
}

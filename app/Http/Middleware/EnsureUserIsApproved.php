<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if user is not authenticated or is main admin, proceed normally
        if (!auth()->check() || auth()->user()->is_main_admin) {
            return $next($request);
        }

        // allow access to approval.pending and approval.rejected routes without approval check
        if ($request->routeIs('approval.pending', 'approval.rejected')) {
            return $next($request);
        }

        // allow access to logout route
        if ($request->routeIs('logout')) {
            return $next($request);
        }

        // if user is rejected, redirect to rejection page
        if (auth()->user()->is_rejected) {
            return redirect()->route('approval.rejected');
        }

        // if user is not approved, redirect to pending approval page
        if (!auth()->user()->is_approved) {
            return redirect()->route('approval.pending');
        }

        return $next($request);
    }
}

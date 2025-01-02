<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has the 'admin' or 'pharmacy' role
        if (Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'pharmacy')) {
            return $next($request);
        }

        // If the user is not authorized, return a 403 response
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}



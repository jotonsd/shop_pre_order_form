<?php

namespace Joton\PreOrder\Http\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if the user is an admin
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Access denied: Admins only'], 403);
        }

        // Proceed to the next middleware or request
        return $next($request);
    }
}

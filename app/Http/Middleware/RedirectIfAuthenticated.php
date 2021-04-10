<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
   
    public function handle($request, Closure $next, $guard = null)
    {
        // dd(Auth::guard($guard)->check());

        if ($guard === 'client' && Auth::guard($guard)->check()) {
            return redirect( route('client-dashboard'));
        }
        
        if ($guard === 'customer' && Auth::guard($guard)->check()) {
            return redirect()->intended(route('home'));
        }

        if (Auth::guard($guard)->check()) {
            return redirect( route('admin-dashboard'));
        }

        return $next($request);
    }
}

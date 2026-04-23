<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {

            // store intended URL manually
            session(['url.intended' => url()->current()]);

            return redirect()->route('user-login');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfVerified
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->provider || $request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
} 
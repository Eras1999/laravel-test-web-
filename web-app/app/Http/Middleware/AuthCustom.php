<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthCustom
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect()->route('signin')->with('error', 'Please sign in to access this page.');
        }

        return $next($request);
    }
}
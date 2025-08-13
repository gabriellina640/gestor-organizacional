<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthOrganization
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('organization')) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
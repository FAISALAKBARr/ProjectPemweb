<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
  
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses.');
    }
}

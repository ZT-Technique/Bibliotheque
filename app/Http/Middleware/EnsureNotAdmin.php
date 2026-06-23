<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureNotAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->is_admin || (auth()->user()->role ?? null) === 'admin')) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}

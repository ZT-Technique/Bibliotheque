<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }

        $user = auth()->user();
        $isAdmin = $user->is_admin || (($user->role ?? null) === 'admin');

        if (!$isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

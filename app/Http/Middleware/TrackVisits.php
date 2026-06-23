<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Record visit only for successful GET requests to external (public) routes
        // and avoid recording admin or static resources
        if ($request->isMethod('GET') && 
            !$request->ajax() && 
            !$request->is('admin*') && 
            !$request->is('uploads*') &&
            $response->getStatusCode() === 200) {
            
            \App\Models\Visit::create([
                'url' => $request->fullUrl(),
                'path' => $request->path() === '/' ? 'Accueil' : $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $response;
    }
}

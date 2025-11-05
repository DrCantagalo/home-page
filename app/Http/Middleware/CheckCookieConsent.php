<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCookieConsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('permission', false)) {session(['show_cookie' => true]); }
        elseif (session('show_cookie', false))  { session()->forget('show_cookie'); }
        
        return $next($request);
    }
}

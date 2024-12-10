<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // If the session doesn't have 'seller', show 404
        if (session()->has('seller')) {
            return $next($request);
        } else {
            return redirect()->route('404');
        }
        return redirect()->route('home.view');

    }
}

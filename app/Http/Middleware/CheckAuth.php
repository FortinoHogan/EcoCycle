<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('buyer')) {
            return redirect()->route('home.view')->with('error', 'You are Logged In!');
        }

        if (session()->has('seller')) {
            return redirect()->route('home.view')->with('error', 'You are Logged In!');
        }

        return $next($request);
    }
}

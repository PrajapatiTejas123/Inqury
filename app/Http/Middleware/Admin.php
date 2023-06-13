<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->roles == 0 || Auth::user()->roles == 2)
        { 
            return $next($request);
        } 
        else 
        { 
            return redirect()->back()->with('success', 'Access Denied');
        }
    }
}

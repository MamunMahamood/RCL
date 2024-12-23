<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsVolunteer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() || Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
            return $next($request);
            
        }
        return redirect()->route('login')->with('error','Opps! You do not have permission to access.');
    }
}

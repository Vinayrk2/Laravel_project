<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            Auth::logout();
            
            return redirect()->route('filament.admin.auth.login')->with('error', 
                'You are not authorized to access the admin panel.');
        }

        return $next($request);
    }
}
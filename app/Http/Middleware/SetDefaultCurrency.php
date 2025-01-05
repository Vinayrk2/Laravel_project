<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SetDefaultCurrency
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('currency')) {
            Session::put('currency', 'CAD'); // Default to CAD
        }

        return $next($request);
    }
}

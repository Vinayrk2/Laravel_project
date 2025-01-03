<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class GlobalContextMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Attach global options to all views
        $globalOptions = getGlobalOptions($request);
        View::share('globalOptions', $globalOptions);

        return $next($request);
    }
}

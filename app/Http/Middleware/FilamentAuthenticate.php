<?php

namespace App\Http\Middleware;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class FilamentAuthenticate extends Middleware
{
    protected function authenticate($request, array $guards): void
    {
        $guard = config('filament.auth.guard');
        
        if (! $this->auth->guard($guard)->check()) {
            $this->unauthenticated($request, $guards);
            return;
        }

        $user = $this->auth->guard($guard)->user();

        if (! $user->is_admin) {
            $this->unauthenticated($request, $guards);
            return;
        }

        $this->auth->shouldUse($guard);
    }

    protected function redirectTo($request): string
    {
        return route('filament.admin.auth.login');
    }
} 
<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            throw ValidationException::withMessages([
                'email' => __('filament::login.messages.throttled', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]),
            ]);
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'email' => __('filament::login.messages.failed'),
            ]);
        }

        // Check if user is admin
        if (! Filament::auth()->user()->is_admin) {
            Filament::auth()->logout();
            
            throw ValidationException::withMessages([
                'email' => 'You are not authorized to access the admin panel.',
            ]);
        }

        return app(LoginResponse::class);
    }
} 
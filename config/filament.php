<?php

return [
    'auth' => [
        'guard' => env('FILAMENT_AUTH_GUARD', 'web'),
        'pages' => [
            'login' => \Filament\Http\Livewire\Auth\Login::class,
        ],
    ],

    'middleware' => [
        'auth' => [
            \Filament\Http\Middleware\Authenticate::class,
        ],
        'base' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ],

    'prefix' => 'admin',

    'domain' => null,

    'home_url' => '/',

    'path' => env('FILAMENT_PATH', 'admin'),

    'brand' => env('APP_NAME'),

    'colors' => [
        'primary' => env('FILAMENT_COLOR_PRIMARY', 'blue'),
    ],

    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),

    'google_fonts' => [
        'default' => 'Inter',
    ],

    'layout' => [
        'forms' => [
            'actions' => [
                'alignment' => 'left',
            ],
        ],
        'footer' => [
            'should_show_logo' => true,
        ],
        'max_content_width' => null,
        'notifications' => [
            'vertical_alignment' => 'top',
            'alignment' => 'right',
        ],
        'sidebar' => [
            'is_collapsible_on_desktop' => true,
            'groups' => [
                'are_collapsible' => true,
            ],
            'width' => null,
            'collapsed_width' => null,
        ],
    ],
]; 
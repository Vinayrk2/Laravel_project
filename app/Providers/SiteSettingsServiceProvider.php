<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class SiteSettingsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('site.settings', function ($app) {
            return Cache::rememberForever('site_settings', function () {
                return SiteSetting::first() ?? new SiteSetting();
            });
        });
    }

    public function boot()
    {
        try {
            $settings = $this->app->make('site.settings');
            View::share('siteSettings', $settings);
        } catch (\Exception $e) {
            View::share('siteSettings', new SiteSetting());
        }
    }
} 
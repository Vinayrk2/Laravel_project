<?php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use App\Models\Categories;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Supplier;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share global data with all views
        View::composer('*', function ($view) {
            $siteSettings = SiteSetting::find(1);

            $view->with('globalOptions', [
                'services' => Service::all(),
                'links' => Supplier::all(),
                'no_of_items' => 0, // Define this function as needed
                'footer' => $siteSettings ? $siteSettings->getFooterData() : [],
                'header' => $siteSettings ? $siteSettings->getHeaderData() : [],
                'categories' => Categories::pluck('name')->toArray(),
            ]);
        });
    }

    public function register()
    {
        //
    }
}


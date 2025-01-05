<?php

use App\Models\Categories;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Supplier;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

function getSiteSetting($key)
{
    try {
        $settings = Cache::rememberForever('site_settings', function () {
            return SiteSetting::first() ?? new SiteSetting();
        });
        return $settings->$key ?? null;
    } catch (\Exception $e) {
        return null;
    }
}

function getGlobalOptions($request)
{
    // Get cached site settings
    $siteSettings = SiteSetting::first();
    
    // Get cart count from session or calculate if not exists
    $cartCount = session('cart_count', function() {
        return Auth::check() 
            ? Cart::where('user_id', Auth::id())->sum('quantity')
            : 0;
    });

    return [
        'categories' => Categories::pluck('name')->toArray(),
        'services' => Service::all(),
        'suppliers' => Supplier::all(),
        'no_of_items' => $cartCount,
        'footer' => $siteSettings ? $siteSettings->getFooterData() : [],
        'header' => $siteSettings ? $siteSettings->getHeaderData() : [],
    ];
}

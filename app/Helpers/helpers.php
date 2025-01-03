<?php

use App\Models\Categories;
use App\Models\SiteSetting;
use App\Models\Service;
use App\Models\Supplier;

function getGlobalOptions($request)
{
    $siteSettings = SiteSetting::find(1);

    return [
        'categories' => Categories::pluck('name')->toArray(),
        'services' => Service::all(),
        'suppliers' => Supplier::all(),
        'no_of_items' => 0, // Define this function as needed
        'footer' => $siteSettings ? $siteSettings->getFooterData() : [],
        'header' => $siteSettings ? $siteSettings->getHeaderData() : [],
    ];
}

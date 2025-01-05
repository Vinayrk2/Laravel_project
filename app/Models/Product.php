<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'part_number',
        'availability',
        'manufacturer',
        'condition',
        'currency',
        'price',
        'more_details',
        'features',
        'image'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getImageAttribute()
    {
        // Get the first image associated with the product
        $firstImage = $this->images()->first(); // Use the relationship to get the first image

        // Return the image URL or a default image path
        return $firstImage ? asset('storage/' . $firstImage->image) : asset('storage/default.png');
    }
    
    // Accessor to adjust the price based on currency
    public function getAdjustedPriceAttribute()
    {
        $currency = Session::get('currency', 'CAD'); // Default to CAD
        $conversionRate = $currency === 'USD' ? getSiteSetting('currency_rate') : 1; // Conversion rate for USD
        return round($this->price * $conversionRate, 2); // Adjusted price
    }

}


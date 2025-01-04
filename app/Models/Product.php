<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'price',
        'currency',
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
}


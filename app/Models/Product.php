<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'part_number', 'description', 'price', 'category_id', 
        'features', 'more_details', 'manufacturer', 'condition', 'availability',
        'currency'=>'CAD'
    ];

    
    public function category()
{
    return $this->belongsTo(Categories::class, 'category_id'); // Adjust 'category_id' as necessary
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


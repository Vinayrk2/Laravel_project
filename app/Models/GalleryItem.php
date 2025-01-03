<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = ['heading'];

    public function details()
    {
        return $this->hasMany(GalleryItemDetail::class, 'gallery_item_id');
    }

    public function __toString()
    {
        return $this->heading;
    }
}

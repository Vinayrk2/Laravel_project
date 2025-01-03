<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItemDetail extends Model
{
    protected $fillable = ['gallery_item_id', 'image', 'description'];

    public function galleryItem()
    {
        return $this->belongsTo(GalleryItem::class, 'gallery_item_id');
    }

    public function __toString()
    {
        return $this->description ?? '';
    }
}

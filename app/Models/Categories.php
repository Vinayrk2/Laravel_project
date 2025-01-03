<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['id','name', 'image'];

    public function __toString()
    {
        return $this->name;
    }

    public function products()
{
    return $this->hasMany(Product::class, 'category_id');
}
}


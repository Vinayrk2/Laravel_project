<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'description', 'image', 'url'];

    public function __toString()
    {
        return $this->title;
    }
}

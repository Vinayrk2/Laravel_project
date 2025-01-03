<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'image',
        'status',
        'description',
        'service_type',
        'specifications',
        'technical_information',
    ];

    protected $casts = [
        'specifications' => 'array',
        'technical_information' => 'array',
    ];

    public function __toString()
    {
        return $this->name;
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomUser extends Authenticatable
{
    protected $fillable = [
        'email', 'phone_number', 'state', 'first_name', 'last_name'
    ];

    public function __toString()
    {
        return $this->first_name;
    }
}

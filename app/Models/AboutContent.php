<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $table = 'about_contents';

    protected $fillable = [
        'main_description',
        'field1',
        'field1_description',
        'field2',
        'field2_description',
        'field3',
        'field3_description',
    ];

    public static function getInstance()
    {
        return self::firstOrCreate(['id' => 1]);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            if ($model->id === 1) {
                // Ensure only one instance is created
                $model->update(['id' => 1]);
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $fillable = [
        'main_description',
        'field1',
        'field1_description',
        'field2',
        'field2_description',
        'field3',
        'field3_description'
    ];

    public static function getContent()
    {
        return self::firstOrCreate(['id' => 1], [
            'main_description' => 'Default main description',
            'field1' => 'Field 1',
            'field1_description' => 'Field 1 description',
            'field2' => 'Field 2',
            'field2_description' => 'Field 2 description',
            'field3' => 'Field 3',
            'field3_description' => 'Field 3 description',
        ]);
    }


}

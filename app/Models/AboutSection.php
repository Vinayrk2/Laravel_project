<?php

// app/Models/AboutSection.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'about_content_id',
        'title',
        'description',
        'column',
    ];

    protected $casts = [
        'column' => 'array', // Ensure column is cast to an array
    ];

    public function aboutContent()
    {
        return $this->belongsTo(AboutContent::class, 'about_content_id');
    }
}


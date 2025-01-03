<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use HasFactory;

    protected $table = 'home_sections';
    protected $fillable = ['id'];

    public static function boot()
    {
        parent::boot();

        // Ensure only one instance exists
        static::creating(function ($model) {
            $model->id = 1;
        });
    }

    public function items()
    {
        return $this->hasMany(HomeSectionItems::class, 'home_id');
    }

    public function images()
    {
        return $this->hasMany(HomeCaresoleImage::class, 'home_id');
    }

    public static function getInstance()
    {
        return self::firstOrCreate(['id' => 1]);
    }
}

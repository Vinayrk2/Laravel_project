<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCaresoleImage extends Model
{
    use HasFactory;

    protected $table = 'carasole_images';

    protected $fillable = ['home_id', 'image'];

    public function home()
    {
        return $this->belongsTo(HomeSection::class, 'home_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::where('home_id', $model->home_id)->count() >= 4) {
                throw new \Exception("You can only add up to 4 items for the Home Section.");
            }
        });
    }
}

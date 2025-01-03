<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSectionItems extends Model
{
    use HasFactory;

    protected $table = 'home_section_items';

    protected $fillable = ['home_id', 'title', 'description', 'image'];

    public function home()
    {
        return $this->belongsTo(HomeSection::class, 'home_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::where('home_id', $model->home_id)->count() >= 6) {
                throw new \Exception("You can only add up to 6 items for the Home Section.");
            }
        });
    }
}

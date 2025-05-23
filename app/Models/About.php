<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = [
        'title',
        'description',
        'img_alt',
        'img_title',
        'slug',
    ];

    protected $fillable = ['image', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

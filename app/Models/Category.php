<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['title'];

    protected $fillable = ['image', 'row'];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'category_company');
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}

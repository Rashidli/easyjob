<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['short_title', 'description'];

    protected $fillable = ['image', 'title', 'email', 'password', 'name', 'is_active', 'phone'];

    protected $hidden = ['password', 'remember_token'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_company');
    }

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }

    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{

    use SoftDeletes;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_premium' => 'boolean',
            'is_site' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with Company (nullable)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function getIsNewAttribute()
    {
        return $this->updated_at->gt(Carbon::now()->subDays(10));
    }
}

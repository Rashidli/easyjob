<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['short_title', 'description', 'company_id', 'locale'];
}

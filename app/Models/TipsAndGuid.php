<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipsAndGuid extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'image',
        'is_popular',
    ];

    protected $casts = [
        'is_popular' => 'boolean',
    ];
}

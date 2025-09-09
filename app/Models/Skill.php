<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

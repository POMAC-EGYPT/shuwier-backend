<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_languages')
            ->withPivot('language_level')
            ->withTimestamps();
    }
}

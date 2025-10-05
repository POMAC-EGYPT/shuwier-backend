<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'reviewable_id',
        'reviewable_type',
        'user_id',
        'rating',
        'comment',
    ];
    
    protected $with = ['user'];
    
    public function reviewable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

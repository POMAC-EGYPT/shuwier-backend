<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model
{
    protected $fillable = [
        'portfolio_link',
        'other_links',
        'professional_document',
        'headline',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'other_links' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

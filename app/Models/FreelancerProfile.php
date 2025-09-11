<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model
{
    protected $fillable = [
        'linkedin_link',
        'twitter_link',
        'other_freelance_platform_links',
        'portfolio_link',
        'headline',
        'user_id',
        'category_id'
    ];

    protected $casts = [
        'other_freelance_platform_links' => 'array',
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

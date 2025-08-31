<?php

namespace App\Models;

use App\Enum\ApprovalStatus;
use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model
{
    protected $fillable = [
        'linkedin_link',
        'twitter_link',
        'other_freelance_platform_links',
        'portfolio_link',
        'headline',
        'description',
        'approval_status',
        'user_id'
    ];

    protected $casts = [
        'other_freelance_platform_links' => 'array',
        'approval_status' => ApprovalStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

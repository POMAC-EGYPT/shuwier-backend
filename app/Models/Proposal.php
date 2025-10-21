<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{

    protected $fillable = [
        'cover_letter',
        'estimated_time_unit',
        'estimated_time',
        'fees_type',
        'bid_amount',
        'project_id',
        'status',
        'relevant_links',
        'user_id'
    ];

    public function relevantLinks(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? json_decode($value) : null,
            set: fn($value) => $value ? json_encode($value) : null,
        );
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(ProposalAttachment::class);
    }
}

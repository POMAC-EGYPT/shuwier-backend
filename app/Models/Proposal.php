<?php

namespace App\Models;

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
        'user_id'
    ];

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

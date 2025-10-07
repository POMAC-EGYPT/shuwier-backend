<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalAttachment extends Model
{
    protected $fillable = [
        'file_path',
        'user_id',
        'proposal_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}

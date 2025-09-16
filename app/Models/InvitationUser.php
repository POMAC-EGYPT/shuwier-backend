<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationUser extends Model
{
    protected $fillable = [
        'email',
        'expired_at'
    ];
}

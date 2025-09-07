<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioHashtag extends Model
{
    protected $table = 'portfolio_hashtags';

    protected $fillable = [
        'portfolio_id',
        'hashtag_id',
    ];
}

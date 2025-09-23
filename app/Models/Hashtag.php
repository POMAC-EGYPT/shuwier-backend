<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class, 'portfolio_hashtags', 'hashtag_id', 'portfolio_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_hashtags', 'hashtag_id', 'service_id');
    }
}

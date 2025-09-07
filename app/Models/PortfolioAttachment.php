<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioAttachment extends Model
{
    protected $fillable = [
        'portfolio_id',
        'file_path',
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}

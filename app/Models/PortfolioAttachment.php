<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class PortfolioAttachment extends Model
{
    protected $fillable = [
        'portfolio_id',
        'file_path',
        'user_id',
        'is_cover'
    ];

    protected $casts = [
        'is_cover'     => 'boolean',
    ];

    protected $appends = [
        'size'
    ];

    public function getSizeAttribute()
    {
        return Number::fileSize(File::size($this->file_path));
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}

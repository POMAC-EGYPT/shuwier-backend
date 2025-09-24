<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class ServiceAttachment extends Model
{
    protected $fillable = [
        'file_path',
        'user_id',
        'service_id'
    ];

    protected $appends = [
        'size'
    ];

    public function getSizeAttribute()
    {
        return Number::fileSize(File::size($this->file_path));
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceAttachment extends Model
{
    protected $fillable = [
        'file_path',
        'user_id',
        
        'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

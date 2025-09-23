<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFaq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

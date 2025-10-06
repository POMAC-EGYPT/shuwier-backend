<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAttachment extends Model
{
    protected $fillable = [
        'file_path',
        'user_id',
        'project_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
}

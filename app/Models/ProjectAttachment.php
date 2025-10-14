<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Number;

class ProjectAttachment extends Model
{
    protected $fillable = [
        'file_path',
        'user_id',
        'project_id',
    ];

    protected $appends = [
        'size'
    ];

    public function getSizeAttribute()
    {
        return Number::fileSize(File::size($this->file_path));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

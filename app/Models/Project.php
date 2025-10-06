<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'subcategory_id',
        'budget',
        'deadline_unit',
        'deadline',
        'status',
        'comments_enabled',
        'proposals_enabled',
        'submited_proposal_count',
        'user_id'
    ];

    protected $casts = [
        'comments_enabled'  => 'boolean',
        'proposals_enabled' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(ProjectAttachment::class);
    }
}

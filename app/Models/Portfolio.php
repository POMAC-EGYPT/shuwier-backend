<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'subcategory_id',
        'user_id',
        'cover_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'portfolio_hashtags', 'portfolio_id', 'hashtag_id');
    }

    public function attachments()
    {
        return $this->hasMany(PortfolioAttachment::class);
    }
}

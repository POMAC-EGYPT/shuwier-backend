<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'subcategory_id',
        'delivery_time',
        'delivery_time_unit',
        'service_fees_type',
        'price',
        'cover_photo',
        'user_id'
    ];

    protected $appends = [
        'rate'
    ];

    public function getRateAttribute()
    {
        return $this->reviews != null ? round($this->reviews?->avg('rating'), 2) : 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class);
    }

    public function attachments()
    {
        return $this->hasMany(ServiceAttachment::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'service_hashtags', 'service_id', 'hashtag_id');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}

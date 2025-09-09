<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'parent_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    #[Scope]
    protected function parents(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    #[Scope]
    protected function childrens(Builder $query): Builder
    {
        return $query->whereNotNull('parent_id');
    }
}

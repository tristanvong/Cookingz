<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
    ];

    public function scopeRecipeCategories($query)
    {
        return $query->where('type', 'recipe');
    }

    public function scopeFaqCategories($query)
    {
        return $query->where('type', 'faq');
    }

    public function faqItems()
    {
        return $this->hasMany(FAQItem::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}

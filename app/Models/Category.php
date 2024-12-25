<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function faqItems()
    {
        return $this->hasMany(FAQItem::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}

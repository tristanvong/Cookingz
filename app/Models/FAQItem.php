<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class FAQItem extends Model
{
    protected $table = 'faqs';
    protected $fillable = [
        'question',
        'answer',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

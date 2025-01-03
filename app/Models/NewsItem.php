<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

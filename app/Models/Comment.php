<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'user_id', 'news_item_id'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newsItem()
    {
        return $this->belongsTo(NewsItem::class);
    }
}

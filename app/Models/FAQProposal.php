<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQProposal extends Model
{
    protected $table = 'faq_proposals';
    protected $fillable = ['user_id', 'question', 'answer', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

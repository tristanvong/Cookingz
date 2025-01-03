<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    public const PENDING = 'pending';
    public const REPLIED = 'replied';
    protected $fillable = ['name', 'email', 'message', 'status'];
}

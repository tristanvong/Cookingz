<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Recipe;
use App\Models\Review;
use App\Models\Message;
use App\Models\Blacklist;
use App\Notifications\CustomPasswordResetNotification;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    public const USER = 'user';
    public const ADMIN = 'admin';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'date_of_birth',
        'about_me',
        'profile_picture',
        'privacy_mode',
        'is_blacklisted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function publicMessages()
    {
        return $this->receivedMessages()->where('type', 'public');
    }

    public function messages()
    {
        return $this->sentMessages()->orWhere('receiver_id', $this->id);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\CustomEmailVerificationNotification());
    }

    public function blacklist()
    {
        return $this->hasOne(Blacklist::class);
    }

    public function isBlacklisted(): bool
    {
        return $this->blacklist !== null;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordResetNotification($token));
    }
}
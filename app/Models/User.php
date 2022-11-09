<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable , InteractsWithMedia;

    protected $fillable = [
        'username',
        'email',
        'bio',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['media', 'info'];

    public function getFileAttribute(): string
    {
        return $this->getFirstMediaUrl('file');
    }

    public function info($key = null)
    {
        $relation = $this->hasOne(UserInfo::class, 'user_id', 'id');
        if ($key) {
            $relation = $relation->value($key);
        }

        return $relation;
    }
}

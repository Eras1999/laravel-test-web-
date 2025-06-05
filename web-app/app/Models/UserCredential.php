<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserCredential extends Authenticatable
{
    use Notifiable;

    protected $table = 'user_credentials';

    protected $fillable = [
        'name',
        'email',
        'password',
        'terms_accepted',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'terms_accepted' => 'boolean',
    ];

    public function blogs()
    {
        return $this->hasMany(CommunityBlog::class, 'user_id');
    }
}
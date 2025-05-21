<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserCredential extends Model
{
    use HasFactory;

    protected $table = 'user_credentials';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
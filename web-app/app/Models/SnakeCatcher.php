<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnakeCatcher extends Model
{
    protected $fillable = [
        'name',
        'email',
        'image',
        'district',
        'description',
        'mobile_number',
        'facebook_link',
        'status',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];
}
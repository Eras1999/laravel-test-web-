<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RescuePost extends Model
{
    protected $fillable = [
        'author_name',
        'animal_type',
        'image',
        'healthy_status',
        'district',
        'city',
        'place',
        'latitude',
        'longitude',
        'description',
        'contact_number',
        'rescued',
        'user_id',
    ];

    protected $casts = [
        'comments' => 'array',
    ];
}
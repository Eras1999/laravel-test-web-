<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdoptionPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author_name', 'title', 'category', 'description', 'district', 'city', 'nearby_city',
        'mobile_number', 'image', 'status', 'approved_at'
    ];

    protected $dates = ['approved_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(UserCredential::class, 'author_name', 'name');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityBlog extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'image', 'date', 'status', 'author_name'];
    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo(UserCredential::class, 'user_id');
    }
}
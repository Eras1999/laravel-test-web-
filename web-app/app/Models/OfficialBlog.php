<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialBlog extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'content', 'date'];

    protected $dates = ['date'];
}
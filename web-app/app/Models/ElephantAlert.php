<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ElephantAlert extends Model
{
    protected $fillable = [
        'name',
        'mobile_number',
        'district',
        'latitude',
        'longitude',
        'image',
        'elephant_count',
        'health_status',
        'description',
    ];

    protected $attributes = [
        'health_status' => 'healthy',
    ];

    public function scopeToday($query)
    {
        return $query->where('created_at', '>=', Carbon::today()->setTimezone('Asia/Colombo')->startOfDay());
    }
}
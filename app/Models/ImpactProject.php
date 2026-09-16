<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactProject extends Model
{
    protected $fillable = [
        'title',
        'category',
        'location',
        'state',
        'year',
        'description',
        'beneficiaries',
        'photographs',
        'videos',
        'related_news',
        'latitude',
        'longitude',
        'is_featured',
        'order_index',
    ];

    protected $casts = [
        'photographs' => 'array',
        'videos' => 'array',
        'related_news' => 'array',
        'is_featured' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}

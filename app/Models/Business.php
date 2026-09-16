<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'logo_url',
        'industry',
        'description',
        'leadership_role',
        'key_activities',
        'website_url',
        'related_images',
        'related_news',
        'order_index',
    ];

    protected $casts = [
        'key_activities' => 'array',
        'related_images' => 'array',
        'related_news' => 'array',
    ];
}

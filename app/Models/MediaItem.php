<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $fillable = [
        'title',
        'date',
        'platform',
        'category',
        'thumbnail_url',
        'description',
        'video_url',
        'related_topic',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}

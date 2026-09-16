<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PressAsset extends Model
{
    protected $fillable = [
        'title',
        'category',
        'file_size',
        'format',
        'download_url',
        'description',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];
}

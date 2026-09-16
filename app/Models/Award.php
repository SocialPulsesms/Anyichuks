<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'award',
        'year',
        'organization',
        'category',
        'description',
        'photograph_url',
        'source_url',
    ];
}

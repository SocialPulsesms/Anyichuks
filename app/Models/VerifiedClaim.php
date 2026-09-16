<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifiedClaim extends Model
{
    protected $fillable = [
        'claim',
        'category',
        'source_name',
        'source_url',
        'verification_date',
        'verified_by',
        'details',
    ];

    protected $casts = [
        'verification_date' => 'date',
    ];
}

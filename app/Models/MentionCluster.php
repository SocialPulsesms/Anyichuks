<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MentionCluster extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'first_detected_at',
        'last_updated_at',
        'overall_sentiment'
    ];

    protected $casts = [
        'first_detected_at' => 'datetime',
        'last_updated_at' => 'datetime',
    ];

    public function mentions(): HasMany
    {
        return $this->hasMany(Mention::class);
    }
}

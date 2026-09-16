<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SentimentOverride extends Model
{
    protected $fillable = [
        'mention_id',
        'old_sentiment',
        'new_sentiment',
        'overridden_by',
        'overridden_at'
    ];

    protected $casts = [
        'overridden_at' => 'datetime',
    ];

    public function mention(): BelongsTo
    {
        return $this->belongsTo(Mention::class);
    }
}

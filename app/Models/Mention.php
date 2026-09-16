<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mention extends Model
{
    protected $fillable = [
        'mention_cluster_id',
        'mention_source_id',
        'provider_id',
        'title',
        'description',
        'content',
        'url',
        'canonical_url',
        'content_hash',
        'matched_keyword',
        'sentiment',
        'category',
        'importance',
        'confidence_score',
        'entity_confirmed',
        'rejection_reason',
        'published_at',
        'detected_at'
    ];

    protected $casts = [
        'entity_confirmed' => 'boolean',
        'published_at' => 'datetime',
        'detected_at' => 'datetime',
        'confidence_score' => 'double',
    ];

    public function cluster(): BelongsTo
    {
        return $this->belongsTo(MentionCluster::class, 'mention_cluster_id');
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(MentionSource::class, 'mention_source_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(MonitoringProvider::class, 'provider_id');
    }

    public function override(): HasOne
    {
        return $this->hasOne(SentimentOverride::class);
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
}

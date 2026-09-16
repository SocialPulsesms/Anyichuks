<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonitoringRun extends Model
{
    protected $fillable = [
        'provider_id',
        'status',
        'items_fetched',
        'items_accepted',
        'items_rejected',
        'error_message',
        'run_at'
    ];

    protected $casts = [
        'run_at' => 'datetime',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(MonitoringProvider::class, 'provider_id');
    }
}

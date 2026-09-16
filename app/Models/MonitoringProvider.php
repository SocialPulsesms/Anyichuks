<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonitoringProvider extends Model
{
    protected $fillable = [
        'name',
        'type',
        'api_config',
        'polling_interval',
        'last_successful_sync',
        'last_error',
        'rate_limit_status',
        'is_enabled'
    ];

    protected $casts = [
        'api_config' => 'array',
        'rate_limit_status' => 'array',
        'is_enabled' => 'boolean',
        'last_successful_sync' => 'datetime',
    ];

    public function runs(): HasMany
    {
        return $this->hasMany(MonitoringRun::class, 'provider_id');
    }

    public function mentions(): HasMany
    {
        return $this->hasMany(Mention::class, 'provider_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlertRule extends Model
{
    protected $fillable = [
        'name',
        'event_trigger',
        'trigger_conditions',
        'channels',
        'is_active'
    ];

    protected $casts = [
        'trigger_conditions' => 'array',
        'channels' => 'array',
        'is_active' => 'boolean'
    ];

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
}

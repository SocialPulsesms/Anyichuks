<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MentionSource extends Model
{
    protected $fillable = ['name', 'domain', 'logo_url'];

    public function mentions(): HasMany
    {
        return $this->hasMany(Mention::class);
    }
}

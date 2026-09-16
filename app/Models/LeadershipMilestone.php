<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadershipMilestone extends Model
{
    protected $fillable = [
        'year',
        'title',
        'stage',
        'description',
        'photograph_url',
        'related_organization',
        'order_index',
    ];
}

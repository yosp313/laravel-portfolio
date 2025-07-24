<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'location',
        'website',
        'twitter',
        'github',
        'linkedin',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'bio' => 'string',
        'location' => 'string',
        'website' => 'string',
        'twitter' => 'string',
        'github' => 'string',
        'linkedin' => 'string',
    ];
}

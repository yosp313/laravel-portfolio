<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'github_url',
        'live_url',
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'image_url' => 'string',
        'github_url' => 'string',
        'live_url' => 'string',
    ];

    /**
     * Get the skills associated with the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Skill>
     */
    public function skills(): HasMany {
        return $this->hasMany(Skill::class);
    }
}

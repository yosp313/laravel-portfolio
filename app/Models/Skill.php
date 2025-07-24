<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    /** @use HasFactory<\Database\Factories\SkillFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'image_url',
        'project_id',
    ];
    /**
     * @return BelongsTo<Project,Skill>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}

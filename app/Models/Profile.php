<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'avatar_url',
        'website_url',
        'linkedin_url',
        'github_url',
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'bio' => 'string',
        'avatar_url' => 'string',
        'website_url' => 'string',
        'linkedin_url' => 'string',
        'github_url' => 'string',
    ];

    /**
     * Get the avatar URL with fallback
     * @param mixed $value
     */
    public function getAvatarUrlAttribute($value): string
    {
        if ($value && !str_starts_with($value, 'http')) {
            return asset('storage/' . $value);
        }
        return $value ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }
}

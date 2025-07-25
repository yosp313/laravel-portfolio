<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $profile = \App\Models\Profile::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '123-456-7890',
            'bio' => 'A passionate web developer.',
            'avatar_url' => 'https://randomuser.me/api/portraits/women/1.jpg',
            'website_url' => 'https://janedoe.dev',
            'linkedin_url' => 'https://linkedin.com/in/janedoe',
            'github_url' => 'https://github.com/janedoe',
        ]);
        $skills = collect([
            ['name' => 'Laravel', 'image_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg'],
            ['name' => 'Tailwind CSS', 'image_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-plain.svg'],
            ['name' => 'PHP', 'image_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg'],
            ['name' => 'JavaScript', 'image_url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-plain.svg'],
        ])->map(fn($data) => \App\Models\Skill::create($data));
        $projects = [
            [
                'name' => 'Portfolio Website',
                'description' => 'A personal portfolio built with Laravel and Tailwind CSS.',
                'image_url' => 'https://source.unsplash.com/random/400x300?portfolio',
                'github_url' => 'https://github.com/janedoe/portfolio',
                'live_url' => 'https://janedoe.dev',
            ],
            [
                'name' => 'Blog Platform',
                'description' => 'A modern blog platform.',
                'image_url' => 'https://source.unsplash.com/random/400x300?blog',
                'github_url' => 'https://github.com/janedoe/blog',
                'live_url' => 'https://blog.janedoe.dev',
            ],
        ];
        foreach ($projects as $projectData) {
            $project = \App\Models\Project::create($projectData);
            $project->skills()->attach($skills->random(2));
        }
    }
}

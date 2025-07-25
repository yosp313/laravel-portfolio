@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center gap-8">
        <div class="flex flex-col items-center text-center">
            <img src="{{ $profile->avatar_url }}" alt="{{ $profile->name }}" class="w-32 h-32 rounded-full shadow-lg mb-4 border-4 border-gradient-to-tr from-pink-400 via-purple-400 to-blue-400">
            <h1 class="text-4xl font-bold mb-2 bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500 bg-clip-text text-transparent">{{ $profile->name }}</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-2">{{ $profile->bio }}</p>
            <div class="flex gap-4 justify-center mt-2">
                <a href="{{ $profile->github_url }}" target="_blank" class="hover:text-pink-500 transition">GitHub</a>
                <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:text-purple-500 transition">LinkedIn</a>
                <a href="{{ $profile->website_url }}" target="_blank" class="hover:text-blue-500 transition">Website</a>
            </div>
        </div>
        <div class="w-full">
            <h2 class="text-2xl font-semibold mb-4 text-center bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">Featured Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($featuredProjects as $project)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col gap-3 border border-gradient-to-tr from-pink-200 via-purple-200 to-blue-200">
                        <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="rounded mb-3 w-full h-40 object-cover">
                        <h3 class="text-xl font-bold mb-1">{{ $project->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-2">{{ $project->description }}</p>
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($project->skills as $skill)
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-gradient-to-r from-purple-100 via-pink-100 to-blue-100 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700 rounded text-sm">
                                    <img src="{{ $skill->image_url }}" alt="{{ $skill->name }}" class="w-4 h-4"> {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                        <div class="flex gap-4 mt-auto">
                            <a href="{{ $project->github_url }}" target="_blank" class="text-purple-600 hover:text-pink-500 transition">GitHub</a>
                            <a href="{{ $project->live_url }}" target="_blank" class="text-blue-600 hover:text-purple-500 transition">Live Demo</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection 
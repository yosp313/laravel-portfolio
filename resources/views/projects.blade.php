@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-8 text-center bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500 bg-clip-text text-transparent">Projects</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($projects as $project)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 flex flex-col gap-3 border border-gradient-to-tr from-pink-200 via-purple-200 to-blue-200">
                    <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="rounded mb-3 w-full h-40 object-cover">
                    <h2 class="text-2xl font-bold mb-1">{{ $project->name }}</h2>
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
@endsection 
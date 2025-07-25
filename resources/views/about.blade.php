@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto text-center flex flex-col gap-8">
        <h1 class="text-4xl font-bold mb-4 bg-gradient-to-r from-purple-500 via-pink-500 to-blue-500 bg-clip-text text-transparent">About Me</h1>
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">{{ $profile->bio }}</p>
        <div class="flex flex-col items-center gap-4">
            <img src="{{ $profile->avatar_url }}" alt="{{ $profile->name }}" class="w-28 h-28 rounded-full shadow-lg border-4 border-gradient-to-tr from-pink-400 via-purple-400 to-blue-400">
            <div class="flex gap-4 mt-2">
                <a href="{{ $profile->github_url }}" target="_blank" class="hover:text-pink-500 transition">GitHub</a>
                <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:text-purple-500 transition">LinkedIn</a>
                <a href="{{ $profile->website_url }}" target="_blank" class="hover:text-blue-500 transition">Website</a>
            </div>
        </div>
        <h2 class="text-2xl font-semibold mt-8 mb-4 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">Skills</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
            @foreach($skills as $skill)
                <div class="flex flex-col items-center gap-2 p-4 bg-white dark:bg-gray-800 rounded-lg shadow border border-gradient-to-tr from-pink-100 via-purple-100 to-blue-100 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700">
                    <img src="{{ $skill->image_url }}" alt="{{ $skill->name }}" class="w-10 h-10">
                    <span class="font-medium">{{ $skill->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection 
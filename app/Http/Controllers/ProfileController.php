<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $profile = Profile::first();
        $featuredProjects = \App\Models\Project::with('skills')->take(3)->get();
        return view('home', compact('profile', 'featuredProjects'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:profiles,name',
            'email' => 'required|email|unique:profiles,email',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'avatar_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
        ]);
        $profile = Profile::create($validated);
        return redirect()->route('profiles.show', $profile)->with('success', 'Profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile): View
    {
        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile): View
    {
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:profiles,name,' . $profile->id,
            'email' => 'required|email|unique:profiles,email,' . $profile->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'avatar_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
        ]);
        $profile->update($validated);
        return redirect()->route('profiles.show', $profile)->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}

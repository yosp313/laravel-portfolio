<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;

Route::get('/', function () {
    $profile = Profile::first();
    $projects = Project::with('skills')->get();
    $skills = Skill::all();
    $experiences = Experience::orderByDesc('start_year')->get();
    foreach ($experiences as $exp) {
        $exp->description = Experience::cleanMarkdown($exp->description);
    }
    return view('portfolio', compact('profile', 'projects', 'skills', 'experiences'));
})->name('portfolio');

Route::get('/about', function () {
    $profile = Profile::first();
    $skills = Skill::all();
    return view('about', compact('profile', 'skills'));
})->name('about');

Route::get('/projects', function () {
    $projects = Project::with('skills')->get();
    return view('projects', compact('projects'));
})->name('projects');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);
    // You can add mail logic here
    return back()->with('success', 'Thank you for your message!');
});

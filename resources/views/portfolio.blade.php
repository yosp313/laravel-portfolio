@extends('layouts.app')

@section('portfolio')
<div class="min-h-screen bg-[#0a192f] flex flex-col md:flex-row">
    <!-- Sidebar -->
    <aside class="hidden md:flex flex-col justify-between w-72 bg-[#112240] text-white py-12 px-8 fixed inset-y-0 left-0 z-30">
        <div>
            <h1 class="text-4xl font-extrabold leading-tight mb-2">{{ $profile->name }}</h1>
            <h2 class="text-lg font-semibold text-blue-300 mb-6">{{ $profile->bio_title ?? 'Front End Engineer' }}</h2>
            <nav class="flex flex-col gap-2 mt-8">
                <a href="#about" class="font-semibold text-white/90 hover:text-blue-400 transition-all py-1 px-2 rounded nav-link" data-section="about">About</a>
                <a href="#experience" class="font-semibold text-white/70 hover:text-blue-400 transition-all py-1 px-2 rounded nav-link" data-section="experience">Experience</a>
                <a href="#projects" class="font-semibold text-white/70 hover:text-blue-400 transition-all py-1 px-2 rounded nav-link" data-section="projects">Projects</a>
                <a href="#skills" class="font-semibold text-white/70 hover:text-blue-400 transition-all py-1 px-2 rounded nav-link" data-section="skills">Skills</a>
            </nav>
        </div>
        <div class="flex gap-4 mt-8">
            @if($profile->github_url)
                <a href="{{ $profile->github_url }}" target="_blank" aria-label="GitHub" class="hover:text-blue-400">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .5C5.73.5.5 5.73.5 12c0 5.08 3.29 9.39 7.86 10.91.58.11.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.88-1.54-3.88-1.54-.53-1.34-1.3-1.7-1.3-1.7-1.06-.72.08-.71.08-.71 1.17.08 1.79 1.2 1.79 1.2 1.04 1.78 2.73 1.27 3.4.97.11-.75.41-1.27.74-1.56-2.55-.29-5.23-1.28-5.23-5.7 0-1.26.45-2.29 1.19-3.1-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18a11.1 11.1 0 0 1 2.9-.39c.98 0 1.97.13 2.9.39 2.2-1.49 3.17-1.18 3.17-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.84 1.19 3.1 0 4.43-2.69 5.41-5.25 5.7.42.36.79 1.09.79 2.2 0 1.59-.01 2.87-.01 3.26 0 .31.21.68.8.56C20.71 21.39 24 17.08 24 12c0-6.27-5.23-11.5-12-11.5z"/></svg>
                </a>
            @endif
            @if($profile->linkedin_url)
                <a href="{{ $profile->linkedin_url }}" target="_blank" aria-label="LinkedIn" class="hover:text-blue-400">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11 19h-3v-9h3v9zm-1.5-10.28c-.97 0-1.75-.79-1.75-1.75s.78-1.75 1.75-1.75 1.75.79 1.75 1.75-.78 1.75-1.75 1.75zm13.5 10.28h-3v-4.5c0-1.08-.02-2.47-1.5-2.47-1.5 0-1.73 1.17-1.73 2.39v4.58h-3v-9h2.88v1.23h.04c.4-.75 1.38-1.54 2.84-1.54 3.04 0 3.6 2 3.6 4.59v5.72z"/></svg>
                </a>
            @endif
            @if($profile->website_url)
                <a href="{{ $profile->website_url }}" target="_blank" aria-label="Website" class="hover:text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10A15.3 15.3 0 0 1 12 2z"/></svg>
                </a>
            @endif
        </div>
    </aside>
    <!-- Mobile Topbar -->
    <aside class="md:hidden flex items-center justify-between px-4 py-4 bg-[#112240] text-white w-full z-30 sticky top-0">
        <span class="text-2xl font-extrabold">{{ $profile->name }}</span>
        <nav class="flex gap-2">
            <a href="#about" class="font-semibold text-white/90 hover:text-blue-400 transition-all nav-link px-2 py-1 rounded" data-section="about">About</a>
            <a href="#experience" class="font-semibold text-white/70 hover:text-blue-400 transition-all nav-link px-2 py-1 rounded" data-section="experience">Experience</a>
            <a href="#projects" class="font-semibold text-white/70 hover:text-blue-400 transition-all nav-link px-2 py-1 rounded" data-section="projects">Projects</a>
            <a href="#skills" class="font-semibold text-white/70 hover:text-blue-400 transition-all nav-link px-2 py-1 rounded" data-section="skills">Skills</a>
        </nav>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 ml-0 md:ml-72 px-2 sm:px-4 md:px-16 py-8 md:py-24 max-w-4xl mx-auto w-full">
        <!-- About -->
        <section id="about" class="mb-16 md:mb-24 scroll-mt-24">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 text-white">About</h2>
            <p class="text-base md:text-lg text-blue-100 leading-relaxed">{{ $profile->bio_long ?? $profile->bio }}</p>
        </section>
        <!-- Experience -->
        <section id="experience" class="mb-16 md:mb-24 scroll-mt-24">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 text-white">Experience</h2>
            @if(isset($experiences) && count($experiences))
                <div class="flex flex-col gap-6 md:gap-10">
                    @foreach($experiences as $exp)
                        <div>
                            <div class="flex items-center gap-2 text-blue-200 text-xs md:text-sm mb-1">
                                <span>{{ $exp->start_year }} — {{ $exp->end_year ?? 'Present' }}</span>
                            </div>
                            <h3 class="font-semibold text-lg md:text-xl text-white">{{ $exp->title }} <span class="text-blue-300">· {{ $exp->company }}</span></h3>
                            <p class="text-blue-100 text-sm md:text-base mt-1">{{ $exp->description }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-blue-300">No experience added yet.</p>
            @endif
        </section>
        <!-- Projects -->
        <section id="projects" class="mb-16 md:mb-24 scroll-mt-24">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 text-white">Projects</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                @foreach($projects as $i => $project)
                    <div 
                        x-data="{ show: false }" 
                        x-intersect.once="show = true" 
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'" 
                        class="bg-[#112240] rounded-lg shadow p-4 md:p-6 flex flex-col gap-2 md:gap-3 border border-[#233554] transition-all duration-700 ease-out"
                        style="transition-delay: {{ $i * 100 }}ms;"
                    >
                        <img src="{{ $project->image_url }}" alt="{{ $project->name }}" class="rounded mb-2 md:mb-3 w-full h-28 md:h-32 object-cover">
                        <h3 class="text-lg md:text-xl font-bold mb-1 text-white">{{ $project->name }}</h3>
                        <p class="text-blue-100 mb-1 md:mb-2 text-sm md:text-base break-words overflow-hidden">{{ $project->description }}</p>
                        <div class="flex flex-wrap gap-2 mb-1 md:mb-2">
                            @foreach($project->skills as $skill)
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-[#233554] rounded text-xs md:text-sm text-blue-200">
                                    <img src="{{ $skill->image_url }}" alt="{{ $skill->name }}" class="w-4 h-4"> {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                        <div class="flex gap-3 md:gap-4 mt-auto">
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="text-blue-400 hover:text-pink-400 transition text-xs md:text-base">GitHub</a>
                            @endif
                            @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" class="text-pink-400 hover:text-blue-400 transition text-xs md:text-base">Live Demo</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <!-- Skills -->
        <section id="skills" class="mb-16 md:mb-24 scroll-mt-24">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 text-white">Skills</h2>
            <div class="flex flex-wrap gap-4 md:gap-6">
                @foreach($skills as $skill)
                    <div class="flex flex-col items-center gap-2 p-3 md:p-4 bg-[#112240] rounded-lg shadow border border-[#233554] w-24 md:w-32">
                        <img src="{{ $skill->image_url }}" alt="{{ $skill->name }}" class="w-8 h-8 md:w-10 md:h-10">
                        <span class="font-medium text-blue-100 text-xs md:text-base text-center">{{ $skill->name }}</span>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</div>
<script>
// Section highlighting on scroll
const navLinks = document.querySelectorAll('.nav-link');
const sections = ['about', 'experience', 'projects', 'skills'].map(id => document.getElementById(id));
window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        if (section && window.scrollY >= section.offsetTop - 120) {
            current = section.id;
        }
    });
    navLinks.forEach(link => {
        link.classList.remove('text-white/90', 'text-blue-400');
        if (link.dataset.section === current) {
            link.classList.add('text-blue-400');
        } else {
            link.classList.add('text-white/70');
        }
    });
});
</script>
@endsection 
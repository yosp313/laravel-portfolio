@extends('layouts.app')

@section('portfolio')
@php
    use League\CommonMark\CommonMarkConverter;
    use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
    use League\CommonMark\Extension\Table\TableExtension;
    use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
    use League\CommonMark\Environment\Environment;
    use Illuminate\Support\Facades\Storage;

    $environment = new Environment([
        'html_input' => 'strip',
        'allow_unsafe_links' => false,
    ]);
    $environment->addExtension(new CommonMarkCoreExtension());
    $environment->addExtension(new TableExtension());
    $environment->addExtension(new GithubFlavoredMarkdownExtension());

    $md = new CommonMarkConverter([], $environment);
@endphp

<div class="min-h-screen bg-gradient-to-br from-[#0a192f] via-[#112240] to-[#0a192f] selection:bg-blue-500/30 selection:text-white">
    <!-- Fixed Header -->
    <header class="fixed top-0 left-0 right-0 bg-gradient-to-r from-[#0a192f]/90 via-[#112240]/90 to-[#0a192f]/90 backdrop-blur-sm z-50 border-b border-blue-500/10">
        <nav class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="#" class="text-2xl font-bold text-white hover:text-blue-400 transition">
                    {{ explode(' ', $profile->name)[0] }}
                </a>
                <div class="flex items-center space-x-8">
                    <a href="#experience" class="text-sm font-medium text-blue-300 hover:text-blue-400 transition">Experience</a>
                    <a href="#projects" class="text-sm font-medium text-blue-300 hover:text-blue-400 transition">Projects</a>
                    <a href="#skills" class="text-sm font-medium text-blue-300 hover:text-blue-400 transition">Skills</a>
                    <a href="#contact" class="px-4 py-2 text-sm font-medium text-blue-400 border border-blue-400 rounded hover:bg-blue-400/10 transition">Contact</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section with subtle gradient overlay -->
    <section class="relative pt-32 pb-20 px-6 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-500/5 to-transparent pointer-events-none"></div>
        <div class="max-w-5xl mx-auto">
            <div class="space-y-6 text-center">
                <h1 class="text-6xl sm:text-7xl font-bold text-white tracking-tight">
                    {{ $profile->name }}
                </h1>
                <h2 class="text-2xl sm:text-3xl font-medium text-blue-400">
                    {{ $profile->bio_title ?? 'Software Engineer' }}
                </h2>
                <p class="max-w-2xl mx-auto text-lg text-blue-200 leading-relaxed">
                    {{ $profile->bio_long ?? $profile->bio }}
                </p>
                <div class="pt-8">
                    <a href="#contact" class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                        Get in Touch
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section with gradient -->
    <section id="experience" class="relative py-20 px-6 bg-gradient-to-br from-[#112240] via-[#0a192f] to-[#112240]">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-white mb-12 flex items-center">
                <span class="text-blue-400 mr-4">01.</span>Experience
            </h2>
            <div class="space-y-12">
                @foreach($experiences as $exp)
                    <div class="group relative bg-[#1a2332] p-8 rounded-lg hover:shadow-xl transition transform hover:-translate-y-1">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                            <h3 class="text-xl font-bold text-white">{{ $exp->title }}</h3>
                            <div class="text-blue-400">{{ $exp->company }}</div>
                        </div>
                        <div class="text-sm text-blue-300 mb-4">{{ $exp->start_year }} — {{ $exp->end_year ?? 'Present' }}</div>
                        <div class="prose prose-invert max-w-none text-blue-200">{!! $md->convert($exp->description ?? '') !!}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Section with gradient -->
    <section id="projects" class="relative py-20 px-6 bg-gradient-to-br from-[#0a192f] via-[#112240] to-[#0a192f]">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-white mb-12 flex items-center">
                <span class="text-blue-400 mr-4">02.</span>Projects
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($projects as $project)
                    <div class="group bg-[#112240] rounded-lg overflow-hidden hover:shadow-xl transition">
                        <div class="relative">
                            <img src="{{ $project->image_url ? Storage::url($project->image_url) : asset('images/placeholder.png') }}" 
                                 alt="{{ $project->name }}" 
                                 class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-blue-600/20 group-hover:bg-blue-600/10 transition"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-2">{{ $project->name }}</h3>
                            <div class="prose prose-invert max-w-none text-blue-200 mb-4">
                                {!! $md->convert($project->description ?? '') !!}
                            </div>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project->skills as $skill)
                                    <span class="px-2 py-1 text-xs font-medium text-blue-300 bg-blue-900/30 rounded-full">
                                        {{ $skill->name }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex items-center space-x-4">
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" 
                                       class="text-blue-400 hover:text-blue-300 transition">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 .5C5.37.5 0 5.78 0 12.292c0 5.211 3.438 9.63 8.205 11.188.6.111.82-.254.82-.567 0-.28-.01-1.022-.015-2.005-3.338.711-4.042-1.582-4.042-1.582-.546-1.361-1.335-1.725-1.335-1.725-1.087-.731.084-.716.084-.716 1.205.082 1.838 1.215 1.838 1.215 1.07 1.803 2.809 1.282 3.495.981.108-.763.417-1.282.76-1.577-2.665-.295-5.466-1.309-5.466-5.827 0-1.287.465-2.339 1.235-3.164-.135-.298-.54-1.497.105-3.121 0 0 1.005-.316 3.3 1.209.96-.262 1.98-.392 3-.398 1.02.006 2.04.136 3 .398 2.28-1.525 3.285-1.209 3.285-1.209.645 1.624.24 2.823.12 3.121.765.825 1.23 1.877 1.23 3.164 0 4.53-2.805 5.527-5.475 5.817.42.354.81 1.077.81 2.182 0 1.578-.015 2.846-.015 3.229 0 .309.21.678.825.56C20.565 21.917 24 17.495 24 12.292 24 5.78 18.627.5 12 .5z"/>
                                        </svg>
                                    </a>
                                @endif
                                @if($project->live_url)
                                    <a href="{{ $project->live_url }}" target="_blank" 
                                       class="text-blue-400 hover:text-blue-300 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="relative py-20 px-6 bg-gradient-to-br from-[#112240] via-[#0a192f] to-[#112240]">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-white mb-12 flex items-center">
                <span class="text-blue-400 mr-4">03.</span>Skills
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($skills as $skill)
                    <div class="group bg-[#1a2332] p-6 rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:bg-[#233554] border border-transparent hover:border-blue-500/20">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-16 h-16 flex items-center justify-center mb-4 rounded-lg bg-[#0a192f]/50 p-3 group-hover:bg-[#0a192f]/70 transition-all duration-300">
                                <img src="{{ $skill->image_url ? Storage::url($skill->image_url) : asset('images/placeholder.png') }}" 
                                     alt="{{ $skill->name }}" 
                                     class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <span class="text-sm font-medium text-blue-200 group-hover:text-blue-400 transition-colors duration-300">{{ $skill->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section with gradient -->
    <section id="contact" class="relative py-20 px-6 bg-gradient-to-br from-[#0a192f] via-[#112240] to-[#0a192f]">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-white mb-12 flex items-center justify-center">
                <span class="text-blue-400 mr-4">04.</span>Get In Touch
            </h2>
            <p class="text-lg text-blue-200 mb-8">
                I'm currently open to new opportunities. Whether you have a question or just want to say hi, 
                I'll try my best to get back to you!
            </p>
            <a href="mailto:{{ $profile->email }}" 
               class="inline-flex items-center px-8 py-4 text-lg font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                Say Hello
            </a>
        </div>
    </section>
</div>

<script>
// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Enhanced intersection observer
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -10% 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-fade-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('section > div').forEach((el) => {
    observer.observe(el);
});
</script>

<style>
.animate-fade-in {
    animation: fadeIn 0.8s ease-out forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Remove scroll-related styles and keep only hover effects */
.hover-glow:hover {
    box-shadow: 0 0 20px rgba(100, 255, 255, 0.1);
}
</style>
@endsection

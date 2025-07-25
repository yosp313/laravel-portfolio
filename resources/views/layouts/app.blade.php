<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portfolio') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .animated-gradient {
            background: linear-gradient(270deg, #a1c4fd, #c2e9fb, #fbc2eb, #fcb69f, #a1c4fd);
            background-size: 1200% 1200%;
            animation: gradientMove 16s ease infinite;
        }
        @keyframes gradientMove {
            0% {background-position:0% 50%}
            50% {background-position:100% 50%}
            100% {background-position:0% 50%}
        }
        .glass {
            background: rgba(255,255,255,0.7);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            border: 1.5px solid rgba(255,255,255,0.18);
        }
        .glass-dark {
            background: rgba(24,24,32,0.7);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            border: 1.5px solid rgba(40,40,60,0.18);
        }
    </style>
</head>
<body class="min-h-screen font-sans bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 flex flex-col">
    @hasSection('portfolio')
        @yield('portfolio')
    @else
        <div class="h-2 w-full animated-gradient"></div>
        @include('partials.nav')
        <main class="flex-1 flex items-center justify-center py-8">
            <div class="w-full max-w-4xl px-4 glass dark:glass-dark">
                @yield('content')
            </div>
        </main>
        @include('partials.footer')
    @endif
</body>
</html> 
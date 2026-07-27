<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>{{ $title ?? config('app.name', 'DevPortfolio') }}</title>
    <meta name="description" content="{{ $description ?? 'A personal portfolio & development learning log. Showcasing projects, skills, and the journey of continuous learning.' }}">
    <meta name="author" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $title ?? config('app.name', 'DevPortfolio') }}">
    <meta property="og:description" content="{{ $description ?? 'A personal portfolio & development learning log.' }}">
    <meta property="og:type" content="website">

    {{-- Vite (Tailwind CSS + Alpine.js) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-950 text-zinc-100 antialiased min-h-screen flex flex-col">

    {{-- ====================== NAVBAR ====================== --}}
    <header
        x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
        :class="scrolled ? 'shadow-lg shadow-black/30' : ''"
        class="fixed top-0 inset-x-0 z-50 transition-shadow duration-300"
    >
        <nav
            :class="scrolled ? 'bg-zinc-950/90 border-zinc-800/80' : 'bg-transparent border-transparent'"
            class="border-b backdrop-blur-md transition-all duration-300"
        >
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">

                    {{-- Logo / Brand --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <span class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-indigo-500/30 group-hover:bg-indigo-500 transition-colors duration-200">
                            DV
                        </span>
                        <span class="font-semibold text-white tracking-tight">
                            Dev<span class="text-indigo-400">Portfolio</span>
                        </span>
                    </a>

                    {{-- Desktop Nav --}}
                    <div class="hidden md:flex items-center gap-8">
                        <a href="{{ route('home') }}"
                           class="{{ request()->routeIs('home') ? 'nav-link-active' : 'nav-link' }} pb-1">
                            Home
                        </a>
                        <a href="{{ route('home') }}#projects"
                           class="nav-link pb-1">
                            Projects
                        </a>
                        <a href="{{ route('logs.index') }}"
                           class="{{ request()->routeIs('logs.*') ? 'nav-link-active' : 'nav-link' }} pb-1">
                            Progress Log
                        </a>
                    </div>

                    {{-- Desktop CTA --}}
                    <div class="hidden md:flex items-center gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-ghost">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                                </svg>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-ghost">Sign In</a>
                        @endauth
                    </div>

                    {{-- Mobile Menu Button --}}
                    <button
                        id="mobile-menu-toggle"
                        @click="open = !open"
                        class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors duration-200"
                        aria-label="Toggle navigation menu"
                        :aria-expanded="open"
                    >
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu Dropdown --}}
            <div
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="md:hidden border-t border-zinc-800/80 bg-zinc-950/95 backdrop-blur-md"
            >
                <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col gap-1">
                    <a href="{{ route('home') }}"
                       @click="open = false"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('home') ? 'text-white bg-zinc-800' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }} transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                        </svg>
                        Home
                    </a>
                    <a href="{{ route('home') }}#projects"
                       @click="open = false"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Projects
                    </a>
                    <a href="{{ route('logs.index') }}"
                       @click="open = false"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ request()->routeIs('logs.*') ? 'text-white bg-zinc-800' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/60' }} transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Progress Log
                    </a>

                    <div class="pt-2 mt-1 border-t border-zinc-800">
                        @auth
                            <a href="{{ route('dashboard') }}" @click="open = false" class="btn-ghost w-full justify-center mt-2">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" @click="open = false" class="btn-ghost w-full justify-center mt-2">
                                Sign In
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    {{-- ====================== MAIN CONTENT ====================== --}}
    <main class="flex-1 pt-16">
        {{ $slot }}
    </main>

    {{-- ====================== FOOTER ====================== --}}
    <footer class="border-t border-zinc-800/60 mt-auto">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Brand Column --}}
                <div class="space-y-3">
                    <div class="flex items-center gap-2.5">
                        <span class="w-7 h-7 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                            DV
                        </span>
                        <span class="font-semibold text-white text-sm tracking-tight">
                            Dev<span class="text-indigo-400">Portfolio</span>
                        </span>
                    </div>
                    <p class="text-zinc-500 text-sm leading-relaxed">
                        Personal portfolio & development learning log. Building in public, one commit at a time.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div class="space-y-3">
                    <h4 class="text-xs font-semibold text-zinc-400 uppercase tracking-widest">Navigation</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-sm text-zinc-500 hover:text-indigo-400 transition-colors duration-200">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#projects" class="text-sm text-zinc-500 hover:text-indigo-400 transition-colors duration-200">Projects</a>
                        </li>
                        <li>
                            <a href="{{ route('logs.index') }}" class="text-sm text-zinc-500 hover:text-indigo-400 transition-colors duration-200">Progress Log</a>
                        </li>
                    </ul>
                </div>

                {{-- Social / Stack Info --}}
                <div class="space-y-3">
                    <h4 class="text-xs font-semibold text-zinc-400 uppercase tracking-widest">Built With</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Laravel', 'PHP 8.3', 'Tailwind CSS', 'Alpine.js', 'MySQL'] as $tech)
                            <span class="px-2.5 py-1 rounded-md bg-zinc-800/80 text-zinc-400 text-xs border border-zinc-700/40">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Footer Bottom --}}
            <div class="mt-10 pt-6 border-t border-zinc-800/60 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-zinc-600">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
                <p class="text-xs text-zinc-700">
                    Crafted with <span class="text-indigo-500">&hearts;</span> using Laravel & Tailwind CSS
                </p>
            </div>
        </div>
    </footer>

    {{-- Additional scripts slot --}}
    {{ $scripts ?? '' }}

</body>
</html>

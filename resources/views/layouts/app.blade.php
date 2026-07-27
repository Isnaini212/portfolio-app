<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236366f1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polygon points='12 2 2 7 12 12 22 7 12 2'/><polyline points='2 17 12 22 22 17'/><polyline points='2 12 12 17 22 12'/></svg>">

    {{-- SEO --}}
    <title>{{ isset($title) ? $title . ' — ' . config('app.name', 'DevPortfolio') : 'DevPortfolio — Personal Portfolio & DevLog' }}</title>
    <meta name="description" content="{{ $description ?? 'A personal portfolio & development learning log. Showcasing projects, skills, and the journey of continuous learning.' }}">
    <meta name="author" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $title ?? config('app.name', 'DevPortfolio') }}">
    <meta property="og:description" content="{{ $description ?? 'A personal portfolio & development learning log.' }}">
    <meta property="og:type" content="website">

    {{-- GSAP (CDN — loaded before Vite so it's available to inline scripts) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>

    {{-- Vite (Tailwind CSS + Alpine.js) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* x-cloak hides Alpine elements before init */
        [x-cloak] { display: none !important; }

        /* ---- Preloader ---- */
        #preloader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: #09090b;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1.25rem;
            pointer-events: none;
        }
        #preloader-logo {
            font-family: 'JetBrains Mono', monospace, sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: #d4d4d8;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            opacity: 0;
            transform: translateY(12px);
            text-align: center;
        }
        #preloader-bar-track {
            width: 140px;
            height: 2px;
            background: #27272a;
            border-radius: 2px;
            overflow: hidden;
            opacity: 0;
        }
        #preloader-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899);
            border-radius: 2px;
        }

        /* ---- Spotlight overlay ---- */
        #spotlight-overlay {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            transition: background 0.08s linear;
        }

        /* ---- Noise grain texture ---- */
        #noise-overlay {
            position: fixed;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            opacity: 0.035;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 200px 200px;
        }
    </style>
</head>

<body class="bg-zinc-950 text-zinc-100 antialiased min-h-screen flex flex-col">

    {{-- ====================== PRELOADER ====================== --}}
    <div id="preloader" aria-hidden="true" role="presentation">
        <div id="preloader-logo">
            {{ \App\Models\Setting::get('preloader_text', 'WELCOME TO MY PORTFOLIO') }}
        </div>
        <div id="preloader-bar-track">
            <div id="preloader-bar"></div>
        </div>
    </div>

    {{-- ====================== SPOTLIGHT OVERLAY ====================== --}}
    <div id="spotlight-overlay" aria-hidden="true"></div>

    {{-- ====================== NOISE GRAIN ====================== --}}
    <div id="noise-overlay" aria-hidden="true"></div>

    {{-- ====================== NAVBAR ====================== --}}
    <header
        x-data="{ open: false, scrolled: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
        :class="scrolled ? 'shadow-lg shadow-black/30' : ''"
        class="fixed top-0 inset-x-0 z-50 transition-shadow duration-300"
        id="main-header"
    >
        <nav
            :class="scrolled ? 'bg-zinc-950/90 border-zinc-800/80' : 'bg-transparent border-transparent'"
            class="border-b backdrop-blur-md transition-all duration-300"
        >
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">

                    {{-- Brand Logo --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-8 h-8 rounded-lg bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center group-hover:bg-indigo-600/30 group-hover:border-indigo-500/50 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                        </div>
                        <span class="font-bold text-white tracking-tight text-base group-hover:text-indigo-300 transition-colors">
                            Dev<span class="text-indigo-400">Portfolio</span>
                        </span>
                    </a>

                    {{-- Desktop Nav --}}
                    <div class="hidden md:flex items-center gap-8" id="nav-desktop-links">
                        <a href="{{ route('home') }}"
                           class="{{ request()->routeIs('home') ? 'nav-link-active' : 'nav-link' }} pb-1">
                            Home
                        </a>
                        <a href="{{ route('home') }}#projects"
                           class="nav-link pb-1">
                            Projects
                        </a>
                        <a href="{{ route('home') }}#devlog-preview"
                           class="nav-link pb-1">
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
                            <a href="{{ route('login') }}" class="btn-ghost" id="nav-signin">Sign In</a>
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
                    <a href="{{ route('home') }}#devlog-preview"
                       @click="open = false"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-zinc-400 hover:text-white hover:bg-zinc-800/60 transition-colors duration-200">
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
    <main class="flex-1 pt-16 relative z-10">
        {{ $slot }}
    </main>

    {{-- ====================== FOOTER ====================== --}}
    <footer class="border-t border-zinc-800/60 mt-auto relative z-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Quick Links --}}
                <div class="space-y-3">
                    <h4 class="text-xs font-semibold text-zinc-400 uppercase tracking-widest">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-sm text-zinc-500 hover:text-indigo-400 transition-colors duration-200">Home</a></li>
                        <li><a href="{{ route('home') }}#projects" class="text-sm text-zinc-500 hover:text-indigo-400 transition-colors duration-200">Projects</a></li>
                        <li><a href="{{ route('home') }}#devlog-preview" class="text-sm text-zinc-500 hover:text-indigo-400 transition-colors duration-200">Progress Log</a></li>
                    </ul>
                </div>

                {{-- Tech Stack --}}
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

    {{-- ====================== SCRIPTS ====================== --}}

    {{-- GSAP Preloader animation (runs after GSAP CDN deferred script is ready) --}}
    <script>
        window.addEventListener('load', function () {
            // GSAP may not yet be defined if the CDN hasn't resolved;
            // we wrap in a short rAF loop to wait for it safely.
            function runPreloader() {
                if (typeof gsap === 'undefined') {
                    requestAnimationFrame(runPreloader);
                    return;
                }

                var logo    = document.getElementById('preloader-logo');
                var track   = document.getElementById('preloader-bar-track');
                var bar     = document.getElementById('preloader-bar');
                var overlay = document.getElementById('preloader');

                var tl = gsap.timeline({
                    onComplete: function () {
                        overlay.style.display = 'none';
                    }
                });

                // 1. Fade-in logo + bar track
                tl.to([logo, track], {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    ease: 'power2.out',
                    stagger: 0.1
                });

                // 2. Animate the progress bar
                tl.to(bar, {
                    width: '100%',
                    duration: 0.7,
                    ease: 'power1.inOut'
                }, '-=0.1');

                // 3. Short pause
                tl.to({}, { duration: 0.2 });

                // 4. Slide the whole preloader up and fade out
                tl.to(overlay, {
                    yPercent: -100,
                    opacity: 0,
                    duration: 0.65,
                    ease: 'power3.inOut'
                });

                // 5. Animate hero elements in after preloader exits
                tl.from('#hero-status-badge', {
                    opacity: 0,
                    y: 16,
                    duration: 0.5,
                    ease: 'power2.out'
                }, '-=0.1');

                tl.from('#hero-headline', {
                    opacity: 0,
                    y: 24,
                    duration: 0.6,
                    ease: 'power2.out'
                }, '-=0.3');

                tl.from('#hero-bio', {
                    opacity: 0,
                    y: 16,
                    duration: 0.5,
                    ease: 'power2.out'
                }, '-=0.4');

                tl.from('#hero-cta-row', {
                    opacity: 0,
                    y: 12,
                    duration: 0.45,
                    ease: 'power2.out'
                }, '-=0.35');

                if (document.getElementById('hero-avatar-card')) {
                    tl.from('#hero-avatar-card', {
                        opacity: 0,
                        scale: 0.88,
                        duration: 0.7,
                        ease: 'back.out(1.4)'
                    }, '-=0.6');
                }

                tl.from('#hero-social-row', {
                    opacity: 0,
                    y: 8,
                    duration: 0.4,
                    ease: 'power2.out'
                }, '-=0.3');
            }

            runPreloader();
        });
    </script>

    {{-- Spotlight mouse-tracking effect --}}
    <script>
        (function () {
            var overlay = document.getElementById('spotlight-overlay');
            if (!overlay) return;

            var mouseX = window.innerWidth / 2;
            var mouseY = window.innerHeight / 2;
            var currentX = mouseX;
            var currentY = mouseY;
            var raf;

            document.addEventListener('mousemove', function (e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            function lerp(a, b, t) { return a + (b - a) * t; }

            function tick() {
                currentX = lerp(currentX, mouseX, 0.07);
                currentY = lerp(currentY, mouseY, 0.07);

                overlay.style.background =
                    'radial-gradient(600px at ' + currentX + 'px ' + currentY + 'px, rgba(99,102,241,0.09), transparent 80%)';

                raf = requestAnimationFrame(tick);
            }

            tick();
        })();
    </script>

    {{-- Additional page-specific scripts slot --}}
    {{ $scripts ?? '' }}

</body>
</html>

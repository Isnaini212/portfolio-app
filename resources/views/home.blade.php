<x-app-layout title="Home — DevPortfolio" description="Personal portfolio & learning log. Showcasing projects, skills, and the journey of continuous growth as a full-stack developer.">

    {{-- ========================================================== --}}
    {{-- HERO SECTION — Syed Moinuddin / 21st.dev editorial style   --}}
    {{-- ========================================================== --}}
    <section class="relative w-full min-h-screen flex flex-col justify-center overflow-hidden bg-zinc-950" id="hero-section">

        {{-- ── Interactive Galaxy Particle Canvas Background ───────── --}}
        <canvas id="galaxy-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>

        {{-- ── Ambient background glows ────────────────────────────── --}}
        <div class="absolute inset-0 pointer-events-none select-none z-0" aria-hidden="true">
            <div class="absolute -top-32 left-1/4 w-[800px] h-[600px] bg-indigo-700/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-purple-700/8 rounded-full blur-[100px]"></div>
            <div class="absolute top-1/2 left-0 w-[400px] h-[400px] bg-sky-700/6 rounded-full blur-[80px]"></div>
            {{-- Very subtle dot grid --}}
            <div class="absolute inset-0"
                 style="background-image: radial-gradient(circle, rgba(99,102,241,0.07) 1px, transparent 1px); background-size: 36px 36px; opacity: 0.4;">
            </div>
        </div>

        {{-- ── Content wrapper ──────────────────────────────────────── --}}
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-8 lg:px-12 pt-28 pb-16 lg:pb-24">

            {{-- ┌─────────────────────────────────────────────────────┐ --}}
            {{-- │  TOP ROW: Status badge + availability indicator     │ --}}
            {{-- └─────────────────────────────────────────────────────┘ --}}
            <div class="flex items-center justify-between mb-6 sm:mb-10" id="hero-status-badge">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 text-xs font-semibold uppercase tracking-widest">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                    </span>
                    {{ $settings['hero_status_badge'] ?? 'Open to work' }}
                </div>
                <div class="hidden sm:flex items-center gap-2 text-zinc-500 text-xs font-medium">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    {{ $settings['hero_sub_badge'] ?? 'Building & learning in public' }}
                </div>
            </div>

            {{-- ┌─────────────────────────────────────────────────────┐ --}}
            {{-- │  DISPLAY HEADLINE — full-width typographic layout   │ --}}
            {{-- └─────────────────────────────────────────────────────┘ --}}
            <div class="relative z-10" id="hero-headline">
                {{-- Line 1: left aligned --}}
                <div class="overflow-hidden mb-[-0.08em]">
                    <p class="text-[clamp(3.5rem,10vw,9rem)] font-black leading-none tracking-[-0.04em] text-zinc-100 uppercase select-none">
                        {{ $settings['hero_headline_1'] ?? 'Full-Stack' }}
                    </p>
                </div>

                {{-- Line 2: right aligned --}}
                <div class="overflow-hidden mb-[-0.04em]">
                    <p class="text-[clamp(3.5rem,10vw,9rem)] font-black leading-none tracking-[-0.04em] uppercase select-none text-right"
                       style="background: linear-gradient(135deg, #e4e4e7 0%, #a1a1aa 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        {{ $settings['hero_headline_2'] ?? 'Developer' }}
                    </p>
                </div>

                {{-- Line 3: right aligned gradient --}}
                <div class="overflow-hidden">
                    <p class="text-[clamp(3.5rem,10vw,9rem)] font-black leading-none tracking-[-0.04em] uppercase select-none text-right gradient-text">
                        {{ $settings['hero_headline_3'] ?? '& DevLog' }}
                    </p>
                </div>
            </div>

            {{-- ┌─────────────────────────────────────────────────────┐ --}}
            {{-- │  BOTTOM ROW: Left bio + Right CTA                   │ --}}
            {{-- └─────────────────────────────────────────────────────┘ --}}
            <div class="mt-16 sm:mt-20 grid grid-cols-1 sm:grid-cols-2 gap-8 items-end">

                {{-- Left column: bio text + social links --}}
                <div class="space-y-6" id="hero-bio">
                    <p class="text-zinc-400 text-base leading-relaxed max-w-sm">
                        {{ $settings['hero_bio'] ?? 'Building performant web applications using Laravel, Tailwind CSS, and Alpine.js. Documenting every step of the journey here.' }}
                    </p>

                    {{-- Social icons row --}}
                    <div class="flex items-center gap-3" id="hero-social-row">
                        <a href="https://github.com/Isnaini212" target="_blank" rel="noopener noreferrer"
                           id="social-github"
                           aria-label="GitHub profile"
                           class="w-9 h-9 flex items-center justify-center rounded-lg bg-zinc-800/80 border border-zinc-700/50 text-zinc-400 hover:text-white hover:border-indigo-500/60 hover:bg-indigo-500/10 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"
                           id="social-linkedin"
                           aria-label="LinkedIn profile"
                           class="w-9 h-9 flex items-center justify-center rounded-lg bg-zinc-800/80 border border-zinc-700/50 text-zinc-400 hover:text-white hover:border-sky-500/60 hover:bg-sky-500/10 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="mailto:{{ $settings['hero_email'] ?? 'hello@example.com' }}"
                           id="social-email"
                           aria-label="Send an email"
                           class="w-9 h-9 flex items-center justify-center rounded-lg bg-zinc-800/80 border border-zinc-700/50 text-zinc-400 hover:text-white hover:border-pink-500/60 hover:bg-pink-500/10 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </a>
                        <span class="ml-1 text-xs text-zinc-600 font-medium">{{ $settings['hero_email'] ?? 'hello@example.com' }}</span>
                    </div>
                </div>

                {{-- Right column: CTA buttons --}}
                <div class="flex flex-col sm:items-end gap-3" id="hero-cta-row">
                    {{-- Primary: "BOOK A CALL" style — thick border, uppercase --}}
                    <a href="{{ route('home') }}#projects"
                       id="hero-cta-projects"
                       class="group inline-flex items-center gap-3 px-7 py-4 rounded-full border-2 border-white/90 text-white font-bold text-sm uppercase tracking-widest hover:bg-white hover:text-zinc-950 transition-all duration-300 shadow-lg hover:shadow-white/10">
                        <span>View Projects</span>
                        <span class="w-5 h-5 rounded-full border-2 border-current flex items-center justify-center group-hover:rotate-45 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                    {{-- Secondary: ghost button --}}
                    <a href="{{ route('home') }}#devlog-preview"
                       id="hero-cta-devlog"
                       class="inline-flex items-center gap-3 px-7 py-4 rounded-full border border-zinc-700/70 text-zinc-300 font-semibold text-sm uppercase tracking-wider hover:border-indigo-500/70 hover:text-indigo-300 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Dev Log
                    </a>
                    {{-- Micro-stat below CTAs --}}
                    <p class="text-zinc-600 text-xs mt-1">
                        {{ $featuredProjects->count() }} featured {{ Str::plural('project', $featuredProjects->count()) }}
                        &nbsp;·&nbsp;
                        {{ $recentLogs->count() }} recent {{ Str::plural('log', $recentLogs->count()) }}
                    </p>
                </div>
            </div>

            {{-- ── Scroll indicator ────────────────────────────────── --}}
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 hidden lg:flex flex-col items-center gap-1.5 text-zinc-700" aria-hidden="true">
                <span class="text-[10px] font-semibold uppercase tracking-[0.25em]">Scroll</span>
                <div class="w-px h-8 bg-gradient-to-b from-zinc-600 to-transparent animate-pulse"></div>
            </div>
        </div>
    </section>

    {{-- ========================================================== --}}
    {{-- CATEGORY STATS STRIP                                        --}}
    {{-- ========================================================== --}}
    <section class="border-y border-zinc-800/60 bg-zinc-900/30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12">
                @foreach($categories as $category)
                    <div class="flex items-center gap-3 group">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-500/20 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-zinc-200">{{ $category->name }}</p>
                            <p class="text-xs text-zinc-500">
                                {{ $category->projects_count }} {{ Str::plural('project', $category->projects_count) }}
                                &middot;
                                {{ $category->learning_logs_count }} {{ Str::plural('log', $category->learning_logs_count) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========================================================== --}}
    {{-- PROJECTS SECTION                                            --}}
    {{-- ========================================================== --}}
    <section id="projects" class="py-24 lg:py-32">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-12">
                <div>
                    <p class="text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-2">My Work</p>
                    <h2 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Featured Projects</h2>
                    <p class="mt-3 text-zinc-400 text-base max-w-xl">
                        A curated selection of projects I've built — from full-stack web apps to tools and experiments.
                    </p>
                </div>
            </div>

            {{-- Alpine.js Category Filter + Cards --}}
            <div
                x-data="{
                    activeTab: 'all',
                    selectedProject: null,
                    openModal(project) {
                        this.selectedProject = project;
                        document.body.classList.add('overflow-hidden');
                    },
                    closeModal() {
                        this.selectedProject = null;
                        document.body.classList.remove('overflow-hidden');
                    },
                    projects: {!! Js::from($featuredProjects->map(fn($p) => [
                        'id' => $p->id,
                        'title' => $p->title,
                        'slug' => $p->slug,
                        'description' => $p->description,
                        'tech_stack' => $p->tech_stack,
                        'github_url' => $p->github_url,
                        'demo_url' => $p->demo_url,
                        'is_featured' => $p->is_featured,
                        'category_name' => $p->category?->name ?? 'General',
                        'category_slug' => $p->category?->slug ?? 'general',
                        'collaboration_type' => $p->collaboration_type ?? 'solo',
                        'image' => $p->image ? Storage::url($p->image) : null,
                        'readme_html' => $p->readme ? Illuminate\Support\Str::markdown($p->readme) : null,
                    ])) !!},
                    get filtered() {
                        if (this.activeTab === 'all') return this.projects;
                        return this.projects.filter(p => p.category_slug === this.activeTab);
                    }
                }"
                @keydown.window.escape="closeModal()"
                id="projects-filter-container"
            >
                {{-- Filter Tabs --}}
                <div class="flex flex-wrap gap-2 mb-10" role="tablist" aria-label="Filter projects by category">
                    <button
                        id="tab-all"
                        @click="activeTab = 'all'"
                        :class="activeTab === 'all'
                            ? 'bg-indigo-600 text-white border-indigo-600 shadow-lg shadow-indigo-500/20'
                            : 'bg-transparent text-zinc-400 border-zinc-700/50 hover:text-white hover:border-zinc-600'"
                        class="px-4 py-2 rounded-lg text-sm font-medium border transition-all duration-200"
                        role="tab"
                        :aria-selected="activeTab === 'all'"
                    >
                        All
                    </button>
                    @foreach($categories as $category)
                        <button
                            id="tab-{{ $category->slug }}"
                            @click="activeTab = (activeTab === '{{ $category->slug }}' ? 'all' : '{{ $category->slug }}')"
                            :class="activeTab === '{{ $category->slug }}'
                                ? 'bg-indigo-600 text-white border-indigo-600 shadow-lg shadow-indigo-500/20'
                                : 'bg-transparent text-zinc-400 border-zinc-700/50 hover:text-white hover:border-zinc-600'"
                            class="px-4 py-2 rounded-lg text-sm font-medium border transition-all duration-200"
                            role="tab"
                            :aria-selected="activeTab === '{{ $category->slug }}'"
                        >
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                {{-- Project Cards Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="project in filtered" :key="project.id">
                        <article
                            class="glass-card glow-hover flex flex-col overflow-hidden group transition-all duration-300 hover:-translate-y-1"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                        >
                            {{-- Card Thumbnail --}}
                            <div @click="openModal(project)"
                                 class="h-44 bg-gradient-to-br from-zinc-800/80 to-zinc-900/60 relative overflow-hidden flex items-center justify-center cursor-pointer group/thumb">
                                
                                {{-- Project Image (if exists) --}}
                                <template x-if="project.image">
                                    <div class="absolute inset-0 w-full h-full">
                                        <img :src="project.image" :alt="project.title" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-zinc-950/30 group-hover/thumb:bg-zinc-950/10 transition-colors duration-300"></div>
                                    </div>
                                </template>

                                {{-- Fallback Placeholder --}}
                                <template x-if="!project.image">
                                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                                        {{-- Decorative pattern --}}
                                        <div class="absolute inset-0 opacity-20"
                                             style="background-image: radial-gradient(circle at 20% 50%, rgba(99,102,241,0.3) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(168,85,247,0.2) 0%, transparent 50%);">
                                        </div>
                                        <div class="relative w-12 h-12 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center group-hover/thumb:scale-110 group-hover/thumb:bg-indigo-500/30 transition-all duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                            </svg>
                                        </div>
                                    </div>
                                </template>

                                {{-- Hover details badge --}}
                                <div class="absolute inset-0 bg-indigo-950/40 opacity-0 group-hover/thumb:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <span class="px-3 py-1.5 rounded-full bg-indigo-600/90 border border-indigo-400/50 text-white text-xs font-semibold shadow-lg shadow-indigo-500/30 flex items-center gap-1.5 backdrop-blur-sm transform translate-y-2 group-hover/thumb:translate-y-0 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Readme & Details
                                    </span>
                                </div>

                                {{-- Featured badge --}}
                                <template x-if="project.is_featured">
                                    <span class="absolute top-3 right-3 z-10 px-2 py-0.5 rounded-full bg-amber-500/90 border border-amber-400/50 text-white text-xs font-medium shadow-lg shadow-amber-500/20 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Featured
                                    </span>
                                </template>
                            </div>

                            {{-- Card Body --}}
                            <div class="flex-1 flex flex-col p-5 gap-3">
                                {{-- Badges --}}
                                <div class="flex flex-wrap items-center gap-2">
                                    {{-- Category Tag --}}
                                    <span class="px-2.5 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-medium"
                                          x-text="project.category_name">
                                    </span>
                                    
                                    {{-- Collaboration Type --}}
                                    <template x-if="project.collaboration_type === 'team'">
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                            Team Project
                                        </span>
                                    </template>
                                    <template x-if="project.collaboration_type === 'solo' || !project.collaboration_type">
                                        <span class="px-2.5 py-1 rounded-full bg-sky-500/10 border border-sky-500/20 text-sky-400 text-xs font-medium flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                            Solo Project
                                        </span>
                                    </template>
                                </div>

                                {{-- Title --}}
                                <h3 @click="openModal(project)"
                                    class="font-semibold text-white text-base leading-snug group-hover:text-indigo-300 transition-colors duration-200 cursor-pointer"
                                    x-text="project.title">
                                </h3>

                                {{-- Description --}}
                                <p class="text-zinc-500 text-sm leading-relaxed flex-1 line-clamp-3"
                                   x-text="project.description">
                                </p>

                                {{-- Tech Stack Pills --}}
                                <div class="flex flex-wrap gap-1.5 mt-1">
                                    <template x-for="tech in project.tech_stack.split(',')" :key="tech">
                                        <span class="px-2 py-0.5 rounded-md bg-zinc-800 border border-zinc-700/50 text-zinc-400 text-xs font-medium"
                                              x-text="tech.trim()">
                                        </span>
                                    </template>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex items-center gap-2 pt-2 border-t border-zinc-800/60">
                                    <template x-if="project.github_url">
                                        <a :href="project.github_url"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg bg-zinc-800/80 border border-zinc-700/50 text-zinc-300 hover:text-white hover:border-zinc-600 text-xs font-medium transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                            </svg>
                                            GitHub
                                        </a>
                                    </template>
                                    <template x-if="project.demo_url">
                                        <a :href="project.demo_url"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg bg-indigo-600/80 border border-indigo-500/40 text-white hover:bg-indigo-500 text-xs font-medium transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                            Live Demo
                                        </a>
                                    </template>
                                    {{-- If no urls at all --}}
                                    <template x-if="!project.github_url && !project.demo_url">
                                        <span class="text-xs text-zinc-600 italic">No links available</span>
                                    </template>
                                </div>
                            </div>
                        </article>
                    </template>

                    {{-- Empty state --}}
                    <template x-if="filtered.length === 0">
                        <div class="col-span-full py-20 text-center">
                            <div class="w-14 h-14 rounded-2xl bg-zinc-800/60 border border-zinc-700/40 flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-zinc-500 text-sm">No projects in this category yet.</p>
                        </div>
                    </template>
                </div>

                {{-- Project Detail Modal --}}
                <template x-teleport="body">
                    <div x-show="selectedProject !== null"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-zinc-950/80 backdrop-blur-md overflow-y-auto"
                         style="display: none;"
                         @click.self="closeModal()">

                        <div x-show="selectedProject !== null"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                             class="relative w-full max-w-4xl max-h-[90vh] bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl overflow-y-auto custom-scrollbar my-auto flex flex-col">

                            {{-- Header banner / Cover image --}}
                            <div class="h-48 sm:h-64 bg-gradient-to-br from-zinc-800 to-zinc-950 relative flex items-center justify-center overflow-hidden shrink-0">
                                <template x-if="selectedProject?.image">
                                    <img :src="selectedProject.image" :alt="selectedProject.title" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!selectedProject?.image">
                                    <div class="absolute inset-0 flex flex-col items-center justify-center opacity-40">
                                        <div class="w-16 h-16 rounded-2xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                            </svg>
                                        </div>
                                    </div>
                                </template>

                                <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-zinc-900/40 to-transparent"></div>

                                {{-- Close button --}}
                                <button @click="closeModal()"
                                        class="fixed sm:absolute top-4 right-4 z-20 w-9 h-9 rounded-full bg-zinc-900/80 border border-zinc-700/60 text-zinc-400 hover:text-white hover:bg-zinc-800 flex items-center justify-center transition-all duration-200 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                {{-- Header Overlay Badges & Title --}}
                                <div class="absolute bottom-4 left-6 right-6 flex flex-col gap-2 z-10">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="px-3 py-1 rounded-full bg-indigo-500/20 border border-indigo-500/30 text-indigo-300 text-xs font-semibold backdrop-blur-sm"
                                              x-text="selectedProject?.category_name">
                                        </span>
                                        <template x-if="selectedProject?.collaboration_type === 'team'">
                                            <span class="px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-semibold backdrop-blur-sm flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                                Team Project
                                            </span>
                                        </template>
                                        <template x-if="selectedProject?.collaboration_type === 'solo' || !selectedProject?.collaboration_type">
                                            <span class="px-3 py-1 rounded-full bg-sky-500/20 border border-sky-500/30 text-sky-300 text-xs font-semibold backdrop-blur-sm flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                Solo Project
                                            </span>
                                        </template>
                                    </div>
                                    <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight drop-shadow-md"
                                        x-text="selectedProject?.title">
                                    </h2>
                                </div>
                            </div>

                            {{-- Modal Body Content --}}
                            <div class="p-6 sm:p-8 space-y-6">
                                
                                {{-- Readme Document Box --}}
                                <div class="rounded-xl border border-zinc-800 bg-zinc-950/70 overflow-hidden shadow-inner">
                                    {{-- Readme File Bar Header --}}
                                    <div class="px-4 py-2.5 bg-zinc-900/90 border-b border-zinc-800 flex items-center justify-between">
                                        <div class="flex items-center gap-2 text-xs font-mono text-zinc-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>README.md</span>
                                        </div>
                                        <span class="text-[11px] font-mono text-zinc-600 uppercase">Project Detail & Documentation</span>
                                    </div>

                                    {{-- If custom README markdown exists --}}
                                    <template x-if="selectedProject?.readme_html">
                                        <div class="p-6 sm:p-8 markdown-body"
                                             x-html="selectedProject.readme_html">
                                        </div>
                                    </template>

                                    {{-- Fallback if no custom README markdown --}}
                                    <template x-if="!selectedProject?.readme_html">
                                        <div class="p-5 space-y-4 text-sm text-zinc-300 leading-relaxed font-sans">
                                            <div>
                                                <h3 class="text-xs uppercase tracking-wider font-semibold text-indigo-400 mb-2 flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                    Project Overview & Description
                                                </h3>
                                                <p class="text-zinc-300 text-sm sm:text-base leading-relaxed whitespace-pre-line"
                                                   x-text="selectedProject?.description">
                                                </p>
                                            </div>

                                            <div class="pt-4 border-t border-zinc-800/80">
                                                <h3 class="text-xs uppercase tracking-wider font-semibold text-indigo-400 mb-3 flex items-center gap-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                                                    Technologies Used & Ecosystem
                                                </h3>
                                                <div class="flex flex-wrap gap-2">
                                                    <template x-for="tech in (selectedProject?.tech_stack || '').split(',')" :key="tech">
                                                        <span class="px-3 py-1.5 rounded-lg bg-zinc-900 border border-zinc-700/60 text-zinc-200 text-xs font-mono font-medium shadow-sm flex items-center gap-1.5">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                                                            <span x-text="tech.trim()"></span>
                                                        </span>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                {{-- Action links inside modal --}}
                                <div class="flex flex-wrap items-center gap-3 pt-2">
                                    <template x-if="selectedProject?.github_url">
                                        <a :href="selectedProject.github_url" target="_blank" rel="noopener noreferrer"
                                           class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-zinc-800 hover:bg-zinc-700 text-white font-medium text-sm transition-all duration-200 border border-zinc-700 shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                            View Source Code
                                        </a>
                                    </template>
                                    <template x-if="selectedProject?.demo_url">
                                        <a :href="selectedProject.demo_url" target="_blank" rel="noopener noreferrer"
                                           class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm transition-all duration-200 border border-indigo-500 shadow-lg shadow-indigo-600/30">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            Visit Live Website
                                        </a>
                                    </template>
                                </div>

                            </div>

                        </div>
                    </div>
                </template>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================================== --}}
    {{-- DEVLOG PREVIEW SECTION                                      --}}
    {{-- ========================================================== --}}
    <section id="devlog-preview" class="py-24 lg:py-32 relative overflow-hidden">

        {{-- Background decoration --}}
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute top-0 right-1/4 w-[500px] h-[400px] bg-purple-600/6 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-12">
                <div>
                    <p class="text-xs font-semibold text-purple-400 uppercase tracking-widest mb-2">DevLog</p>
                    <h2 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Learning Progress</h2>
                    <p class="mt-3 text-zinc-400 text-base max-w-xl">
                        A running log of what I'm learning, building, and exploring — publicly, one entry at a time.
                    </p>
                </div>
                <div class="hidden sm:flex items-center gap-2 shrink-0">
                    <span class="px-3 py-1.5 rounded-full bg-zinc-800/80 border border-zinc-700/50 text-zinc-400 text-xs font-medium">
                        {{ $recentLogs->count() }} Entries
                    </span>
                </div>
            </div>

            {{-- Timeline List --}}
            @if($recentLogs->isNotEmpty())
                <div class="relative">
                    {{-- Vertical timeline line --}}
                    <div class="absolute left-4 sm:left-6 top-0 bottom-0 w-px bg-gradient-to-b from-indigo-500/30 via-purple-500/20 to-transparent" aria-hidden="true"></div>

                    <div class="space-y-4 ml-2">
                        @foreach($recentLogs as $log)
                            @php
                                $statusConfig = match($log->status) {
                                    'completed'   => ['badge' => 'badge-completed',  'icon_color' => 'text-emerald-400', 'dot' => 'bg-emerald-500', 'label' => 'Completed'],
                                    'in_progress' => ['badge' => 'badge-in_progress','icon_color' => 'text-amber-400',   'dot' => 'bg-amber-500',   'label' => 'In Progress'],
                                    default       => ['badge' => 'badge-planning',   'icon_color' => 'text-sky-400',     'dot' => 'bg-sky-500',     'label' => 'Planning'],
                                };
                            @endphp
                            <article class="relative flex gap-5 sm:gap-7 pl-8 sm:pl-12 group"
                                     id="devlog-entry-{{ $log->id }}">
                                {{-- Timeline dot --}}
                                <div class="absolute left-2.5 sm:left-3.5 top-5 w-4 h-4 rounded-full border-2 border-zinc-950 {{ $statusConfig['dot'] }} shadow-sm ring-2 ring-zinc-950 flex-shrink-0 transition-transform duration-200 group-hover:scale-125"
                                     aria-hidden="true">
                                </div>

                                {{-- Card --}}
                                <div class="flex-1 glass-card p-5 glow-hover transition-all duration-300 hover:-translate-y-0.5">
                                    <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="{{ $statusConfig['badge'] }}">
                                                @if($log->status === 'completed')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                @elseif($log->status === 'in_progress')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                                                    </svg>
                                                @endif
                                                {{ $statusConfig['label'] }}
                                            </span>
                                            @if($log->category)
                                                <span class="px-2.5 py-1 rounded-full bg-zinc-800/80 border border-zinc-700/40 text-zinc-400 text-xs font-medium">
                                                    {{ $log->category->name }}
                                                </span>
                                            @endif
                                        </div>
                                        <time class="text-xs text-zinc-600 font-medium tabular-nums shrink-0"
                                              datetime="{{ $log->learned_at->toDateString() }}">
                                            {{ $log->learned_at->format('M d, Y') }}
                                        </time>
                                    </div>

                                    <h3 class="font-semibold text-white text-base mb-2 leading-snug group-hover:text-indigo-300 transition-colors duration-200">
                                        {{ $log->title }}
                                    </h3>
                                    <p class="text-zinc-500 text-sm leading-relaxed whitespace-pre-line">
                                        {{ $log->content }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

            @else
                {{-- Empty state --}}
                <div class="text-center py-20 glass-card">
                    <div class="w-14 h-14 rounded-2xl bg-zinc-800/60 border border-zinc-700/40 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <p class="text-zinc-500 text-sm">No learning logs yet. Start documenting your journey!</p>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-accent mt-6 inline-flex">Add Your First Log</a>
                    @endauth
                </div>
            @endif
        </div>
    </section>

    <x-slot name="scripts">
        <script>
            (function () {
                var canvas = document.getElementById('galaxy-canvas');
                if (!canvas) return;

                var ctx = canvas.getContext('2d');
                var heroSection = document.getElementById('hero-section');
                if (!heroSection) return;

                var width = 0;
                var height = 0;
                var particles = [];
                var trailParticles = [];
                var particleCount = 110; // Denser particle count

                var mouse = { x: -1000, y: -1000, active: false };

                function resize() {
                    width = canvas.width = heroSection.offsetWidth;
                    height = canvas.height = heroSection.offsetHeight;
                }

                // Vibrant Palette
                var colorPalette = [
                    { r: 168, g: 85,  b: 247 }, // Purple #a855f7
                    { r: 139, g: 92,  b: 246 }, // Violet #8b5cf6
                    { r: 99,  g: 102, b: 241 }, // Indigo #6366f1
                    { r: 6,   g: 182, b: 212 }, // Cyan #06b6d4
                    { r: 236, g: 72,  b: 153 }, // Pink #ec4899
                    { r: 244, g: 244, b: 245 }  // Zinc/White #f4f4f5
                ];

                function Particle() {
                    this.reset(true);
                }

                Particle.prototype.reset = function (initial) {
                    // 65% chance to spawn in center zone so the middle area stays active and full
                    if (Math.random() < 0.65 && width && height) {
                        this.x = (width * 0.15) + Math.random() * (width * 0.70);
                        this.y = (height * 0.15) + Math.random() * (height * 0.70);
                    } else {
                        this.x = Math.random() * (width || window.innerWidth);
                        this.y = Math.random() * (height || window.innerHeight);
                    }

                    this.radius = Math.random() * 2.2 + 0.8;
                    this.baseVx = (Math.random() - 0.5) * 0.45;
                    this.baseVy = (Math.random() - 0.5) * 0.45;
                    this.vx = this.baseVx;
                    this.vy = this.baseVy;
                    this.baseAlpha = Math.random() * 0.55 + 0.35;
                    this.alpha = this.baseAlpha;
                    this.pulseSpeed = Math.random() * 0.03 + 0.01;
                    this.pulseAngle = Math.random() * Math.PI * 2;
                    this.color = colorPalette[Math.floor(Math.random() * colorPalette.length)];
                };

                Particle.prototype.update = function () {
                    this.pulseAngle += this.pulseSpeed;
                    this.alpha = this.baseAlpha + Math.sin(this.pulseAngle) * 0.25;
                    if (this.alpha < 0.15) this.alpha = 0.15;
                    if (this.alpha > 0.95) this.alpha = 0.95;

                    if (mouse.active) {
                        var dx = this.x - mouse.x;
                        var dy = this.y - mouse.y;
                        var dist = Math.sqrt(dx * dx + dy * dy);
                        var maxDist = 200;

                        if (dist < maxDist) {
                            var force = (1 - dist / maxDist) * 4.0;
                            var angle = Math.atan2(dy, dx);
                            this.vx += Math.cos(angle) * force * 0.14;
                            this.vy += Math.sin(angle) * force * 0.14;
                        }
                    }

                    this.vx += (this.baseVx - this.vx) * 0.04;
                    this.vy += (this.baseVy - this.vy) * 0.04;

                    this.x += this.vx;
                    this.y += this.vy;

                    if (this.x < 0) this.x = width;
                    if (this.x > width) this.x = 0;
                    if (this.y < 0) this.y = height;
                    if (this.y > height) this.y = 0;
                };

                Particle.prototype.draw = function () {
                    ctx.save();
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);

                    var glow = ctx.createRadialGradient(
                        this.x, this.y, 0,
                        this.x, this.y, this.radius * 4
                    );
                    var c = this.color;
                    glow.addColorStop(0, 'rgba(' + c.r + ',' + c.g + ',' + c.b + ',' + this.alpha + ')');
                    glow.addColorStop(0.4, 'rgba(' + c.r + ',' + c.g + ',' + c.b + ',' + (this.alpha * 0.4) + ')');
                    glow.addColorStop(1, 'rgba(' + c.r + ',' + c.g + ',' + c.b + ',0)');

                    ctx.fillStyle = glow;
                    ctx.fill();
                    ctx.restore();
                };

                // Dynamic Cursor Sparkle Trail Particle
                function TrailParticle(x, y) {
                    this.x = x;
                    this.y = y;
                    this.radius = Math.random() * 2.5 + 1.2;
                    var speed = Math.random() * 2.0 + 0.5;
                    var angle = Math.random() * Math.PI * 2;
                    this.vx = Math.cos(angle) * speed;
                    this.vy = Math.sin(angle) * speed;
                    this.life = 1.0;
                    this.decay = Math.random() * 0.03 + 0.02;
                    this.color = colorPalette[Math.floor(Math.random() * colorPalette.length)];
                }

                TrailParticle.prototype.update = function () {
                    this.x += this.vx;
                    this.y += this.vy;
                    this.vx *= 0.95;
                    this.vy *= 0.95;
                    this.life -= this.decay;
                };

                TrailParticle.prototype.draw = function () {
                    if (this.life <= 0) return;
                    ctx.save();
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, Math.max(0.2, this.radius * this.life), 0, Math.PI * 2);
                    var c = this.color;
                    ctx.fillStyle = 'rgba(' + c.r + ',' + c.g + ',' + c.b + ',' + this.life + ')';
                    ctx.shadowBlur = 8;
                    ctx.shadowColor = 'rgba(' + c.r + ',' + c.g + ',' + c.b + ',' + this.life + ')';
                    ctx.fill();
                    ctx.restore();
                };

                function drawConnections() {
                    if (mouse.active) {
                        for (var i = 0; i < particles.length; i++) {
                            var p = particles[i];
                            var dx = p.x - mouse.x;
                            var dy = p.y - mouse.y;
                            var dist = Math.sqrt(dx * dx + dy * dy);
                            var maxDist = 200;

                            if (dist < maxDist) {
                                var lineAlpha = (1 - dist / maxDist) * 0.55;
                                ctx.save();
                                ctx.beginPath();
                                ctx.moveTo(p.x, p.y);
                                ctx.lineTo(mouse.x, mouse.y);
                                ctx.strokeStyle = 'rgba(129, 140, 248, ' + lineAlpha + ')';
                                ctx.lineWidth = (1 - dist / maxDist) * 1.8;
                                ctx.stroke();
                                ctx.restore();
                            }
                        }

                        // Cursor core glow
                        ctx.save();
                        ctx.beginPath();
                        ctx.arc(mouse.x, mouse.y, 45, 0, Math.PI * 2);
                        var mouseGlow = ctx.createRadialGradient(mouse.x, mouse.y, 0, mouse.x, mouse.y, 45);
                        mouseGlow.addColorStop(0, 'rgba(129, 140, 248, 0.35)');
                        mouseGlow.addColorStop(0.5, 'rgba(168, 85, 247, 0.12)');
                        mouseGlow.addColorStop(1, 'rgba(99, 102, 241, 0)');
                        ctx.fillStyle = mouseGlow;
                        ctx.fill();
                        ctx.restore();
                    }

                    // Inter-particle lines
                    for (var a = 0; a < particles.length; a++) {
                        for (var b = a + 1; b < particles.length; b++) {
                            var pA = particles[a];
                            var pB = particles[b];
                            var dx2 = pA.x - pB.x;
                            var dy2 = pA.y - pB.y;
                            var dist2 = Math.sqrt(dx2 * dx2 + dy2 * dy2);

                            if (dist2 < 90) {
                                var alpha2 = (1 - dist2 / 90) * 0.18;
                                ctx.save();
                                ctx.beginPath();
                                ctx.moveTo(pA.x, pA.y);
                                ctx.lineTo(pB.x, pB.y);
                                ctx.strokeStyle = 'rgba(168, 85, 247, ' + alpha2 + ')';
                                ctx.lineWidth = 0.9;
                                ctx.stroke();
                                ctx.restore();
                            }
                        }
                    }
                }

                function init() {
                    resize();
                    particles = [];
                    trailParticles = [];
                    for (var i = 0; i < particleCount; i++) {
                        particles.push(new Particle());
                    }
                }

                window.addEventListener('resize', resize);

                window.addEventListener('mousemove', function (e) {
                    var rect = heroSection.getBoundingClientRect();
                    var relX = e.clientX - rect.left;
                    var relY = e.clientY - rect.top;

                    if (relX >= 0 && relX <= rect.width && relY >= 0 && relY <= rect.height) {
                        mouse.x = relX;
                        mouse.y = relY;
                        mouse.active = true;

                        // Spawn 2 sparkle particles directly at cursor position on move!
                        if (trailParticles.length < 50) {
                            trailParticles.push(new TrailParticle(relX, relY));
                            trailParticles.push(new TrailParticle(relX, relY));
                        }
                    } else {
                        mouse.active = false;
                    }
                });

                document.addEventListener('mouseleave', function () {
                    mouse.active = false;
                });

                function animate() {
                    ctx.clearRect(0, 0, width, height);

                    drawConnections();

                    for (var i = 0; i < particles.length; i++) {
                        particles[i].update();
                        particles[i].draw();
                    }

                    // Update & draw dynamic mouse trail sparkles
                    for (var t = trailParticles.length - 1; t >= 0; t--) {
                        trailParticles[t].update();
                        trailParticles[t].draw();
                        if (trailParticles[t].life <= 0) {
                            trailParticles.splice(t, 1);
                        }
                    }

                    requestAnimationFrame(animate);
                }

                init();
                animate();
            })();
        </script>
    </x-slot>

</x-app-layout>


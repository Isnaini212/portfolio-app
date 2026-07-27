<x-app-layout title="Progress Log — DevPortfolio" description="Public learning log & development progress. Documenting topics learned, challenges solved, and skills acquired.">

    <div class="relative w-full min-h-screen py-24 sm:py-28">

        {{-- Background ambient glows --}}
        <div class="absolute inset-0 pointer-events-none select-none z-0" aria-hidden="true">
            <div class="absolute top-0 left-1/3 w-[600px] h-[400px] bg-purple-700/10 rounded-full blur-[120px]"></div>
            <div class="absolute top-1/2 right-10 w-[400px] h-[400px] bg-indigo-700/8 rounded-full blur-[100px]"></div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="max-w-2xl mb-12">
                <span class="inline-block text-xs font-semibold text-purple-400 uppercase tracking-widest mb-2">DevLog</span>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight">Learning Progress</h1>
                <p class="mt-4 text-zinc-400 text-base leading-relaxed">
                    A running log of topics I'm studying, concepts I'm mastering, and projects I'm building — publicly, one entry at a time.
                </p>
            </div>

            {{-- Filters --}}
            <form action="{{ route('logs.index') }}" method="GET" class="glass-card p-4 sm:p-6 mb-12 flex flex-col sm:flex-row items-stretch sm:items-center gap-4 justify-between">

                <div class="flex flex-wrap items-center gap-3">
                    {{-- Category filter --}}
                    <div>
                        <label for="filter-category" class="sr-only">Category</label>
                        <select id="filter-category" name="category" onchange="this.form.submit()"
                                class="bg-zinc-900 border border-zinc-700/70 text-zinc-300 text-xs rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-indigo-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status filter --}}
                    <div>
                        <label for="filter-status" class="sr-only">Status</label>
                        <select id="filter-status" name="status" onchange="this.form.submit()"
                                class="bg-zinc-900 border border-zinc-700/70 text-zinc-300 text-xs rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-indigo-500">
                            <option value="">All Statuses</option>
                            @foreach($statuses as $st)
                                <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $st)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if(request('category') || request('status'))
                    <a href="{{ route('logs.index') }}" class="text-xs text-zinc-500 hover:text-zinc-300 font-medium self-center">
                        Reset filters
                    </a>
                @endif
            </form>

            {{-- Logs Timeline List --}}
            @if($logs->isNotEmpty())
                <div class="relative">
                    {{-- Vertical timeline line --}}
                    <div class="absolute left-4 sm:left-6 top-0 bottom-0 w-px bg-gradient-to-b from-indigo-500/40 via-purple-500/20 to-transparent" aria-hidden="true"></div>

                    <div class="space-y-6 ml-2">
                        @foreach($logs as $log)
                            @php
                                $statusConfig = match($log->status) {
                                    'completed'   => ['badge' => 'badge-completed',  'dot' => 'bg-emerald-500', 'label' => 'Completed'],
                                    'in_progress' => ['badge' => 'badge-in_progress','dot' => 'bg-amber-500',   'label' => 'In Progress'],
                                    default       => ['badge' => 'badge-planning',   'dot' => 'bg-sky-500',     'label' => 'Planning'],
                                };
                            @endphp

                            <article class="relative flex gap-5 sm:gap-7 pl-8 sm:pl-12 group" id="log-{{ $log->id }}">
                                {{-- Timeline dot --}}
                                <div class="absolute left-2.5 sm:left-3.5 top-6 w-4 h-4 rounded-full border-2 border-zinc-950 {{ $statusConfig['dot'] }} shadow-sm ring-2 ring-zinc-950 flex-shrink-0 transition-transform duration-200 group-hover:scale-125" aria-hidden="true"></div>

                                {{-- Card --}}
                                <div class="flex-1 glass-card p-6 glow-hover transition-all duration-300">
                                    <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="{{ $statusConfig['badge'] }}">
                                                {{ $statusConfig['label'] }}
                                            </span>
                                            @if($log->category)
                                                <span class="px-2.5 py-1 rounded-full bg-zinc-800/80 border border-zinc-700/40 text-zinc-400 text-xs font-medium">
                                                    {{ $log->category->name }}
                                                </span>
                                            @endif
                                        </div>
                                        <time class="text-xs text-zinc-500 font-medium tabular-nums shrink-0" datetime="{{ $log->learned_at->toDateString() }}">
                                            {{ $log->learned_at->format('M d, Y') }}
                                        </time>
                                    </div>

                                    <h2 class="text-lg font-bold text-white mb-3 group-hover:text-indigo-300 transition-colors duration-200">
                                        {{ $log->title }}
                                    </h2>

                                    <p class="text-zinc-400 text-sm leading-relaxed whitespace-pre-line">
                                        {{ $log->content }}
                                    </p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                {{-- Pagination --}}
                @if($logs->hasPages())
                    <div class="mt-12">
                        {{ $logs->links() }}
                    </div>
                @endif

            @else
                <div class="text-center py-20 glass-card">
                    <div class="w-12 h-12 rounded-xl bg-zinc-800/60 border border-zinc-700/40 flex items-center justify-center mx-auto mb-4 text-zinc-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <p class="text-zinc-500 text-sm">No learning logs match the selected filter criteria.</p>
                    <a href="{{ route('logs.index') }}" class="btn-ghost mt-4 inline-flex text-xs">Clear Filters</a>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>

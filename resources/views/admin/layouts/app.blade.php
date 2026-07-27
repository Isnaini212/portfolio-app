<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236366f1' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polygon points='12 2 2 7 12 12 22 7 12 2'/><polyline points='2 17 12 22 22 17'/><polyline points='2 12 12 17 22 12'/></svg>">
    <title>{{ $title ?? 'Dashboard' }} — {{ config('app.name', 'DevPortfolio') }} Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }

        /* Fixed sidebar layout — no Alpine conflict */
        body { margin: 0; }

        #admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Desktop sidebar: always visible, fixed width */
        #admin-sidebar {
            width: 240px;
            flex-shrink: 0;
            background: #111113;
            border-right: 1px solid #27272a;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
        }

        /* Main body scrolls */
        #admin-body {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            background: #09090b;
            min-height: 100vh;
        }

        /* Mobile: hide sidebar by default, show as overlay */
        @media (max-width: 1023px) {
            #admin-sidebar {
                position: fixed;
                inset-y: 0;
                left: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.25s cubic-bezier(.4,0,.2,1);
                width: 260px;
                height: 100vh;
            }
            #admin-sidebar.open {
                transform: translateX(0);
            }
        }

        /* Form input base style */
        .admin-input {
            width: 100%;
            background: #18181b;
            border: 1px solid #3f3f46;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 14px;
            color: #f4f4f5;
            outline: none;
            transition: border-color 0.15s;
            font-family: inherit;
        }
        .admin-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .admin-input::placeholder { color: #52525b; }
        select.admin-input option { background: #18181b; }
        textarea.admin-input { resize: vertical; }

        /* Table */
        .admin-table { width: 100%; border-collapse: collapse; font-size: 14px; }
        .admin-table th {
            text-align: left;
            padding: 10px 16px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.06em;
            color: #71717a;
            text-transform: uppercase;
            border-bottom: 1px solid #27272a;
        }
        .admin-table td {
            padding: 13px 16px;
            border-bottom: 1px solid #1f1f22;
            vertical-align: middle;
        }
        .admin-table tbody tr:last-child td { border-bottom: none; }
        .admin-table tbody tr:hover { background: rgba(255,255,255,0.02); }
    </style>
</head>

<body class="bg-zinc-950 text-zinc-100 antialiased">

    {{-- Mobile overlay backdrop --}}
    <div id="mobile-backdrop"
         onclick="closeSidebar()"
         class="fixed inset-0 bg-black/60 z-40 hidden lg:hidden"></div>

    <div id="admin-wrapper">

        {{-- ============================================================ --}}
        {{-- SIDEBAR                                                       --}}
        {{-- ============================================================ --}}
        <aside id="admin-sidebar">

            {{-- Logo --}}
            <div style="padding: 0 20px; height: 56px; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid #27272a; flex-shrink: 0;">
                <div style="width:30px;height:30px;border-radius:8px;background:#4f46e5;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;flex-shrink:0;letter-spacing:-0.5px;">
                    DV
                </div>
                <div>
                    <div style="font-size:13px;font-weight:600;color:#f4f4f5;line-height:1.2;">DevPortfolio</div>
                    <div style="font-size:10px;color:#52525b;font-weight:500;">Admin Panel</div>
                </div>
            </div>

            {{-- Nav items --}}
            <nav style="flex:1;padding:16px 10px;overflow-y:auto;" aria-label="Admin navigation">

                @php
                    $navGroups = [
                        'Content' => [
                            ['route' => 'admin.dashboard',        'label' => 'Dashboard',     'match' => 'admin.dashboard',
                             'icon' => 'M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z'],
                            ['route' => 'admin.projects.index',   'label' => 'Projects',      'match' => 'admin.projects.*',
                             'icon' => 'M3 7a2 2 0 012-2h4l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z'],
                            ['route' => 'admin.logs.index',       'label' => 'Learning Logs', 'match' => 'admin.logs.*',
                             'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                            ['route' => 'admin.categories.index', 'label' => 'Categories',    'match' => 'admin.categories.*',
                             'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z'],
                        ],
                        'System' => [
                            ['route' => 'admin.settings.index',   'label' => 'Site Settings', 'match' => 'admin.settings.*',
                             'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                        ],
                    ];
                @endphp

                @foreach($navGroups as $groupLabel => $items)
                    <div style="margin-bottom:8px;">
                        <div style="font-size:10px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:#3f3f46;padding:0 10px 6px;">{{ $groupLabel }}</div>

                        @foreach($items as $item)
                            @php $active = request()->routeIs($item['match']); @endphp
                            <a href="{{ route($item['route']) }}"
                               style="display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:7px;font-size:13px;font-weight:500;text-decoration:none;margin-bottom:2px;transition:background 0.15s, color 0.15s;
                                      {{ $active ? 'background:rgba(99,102,241,0.15);color:#a5b4fc;' : 'color:#71717a;' }}"
                               onmouseover="if(!this.classList.contains('active-nav')) { this.style.background='rgba(255,255,255,0.04)';this.style.color='#e4e4e7'; }"
                               onmouseout="if(!this.classList.contains('active-nav')) { this.style.background='{{ $active ? 'rgba(99,102,241,0.15)' : 'transparent' }}';this.style.color='{{ $active ? '#a5b4fc' : '#71717a' }}'; }"
                               {{ $active ? 'class=active-nav' : '' }}
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                                </svg>
                                {{ $item['label'] }}
                                @if($active)
                                    <div style="margin-left:auto;width:5px;height:5px;border-radius:50%;background:#6366f1;"></div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endforeach

                {{-- Divider --}}
                <div style="border-top:1px solid #27272a;margin:12px 0;padding-top:12px;">
                    <a href="{{ route('home') }}"
                       style="display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:7px;font-size:13px;font-weight:500;color:#3f3f46;text-decoration:none;transition:background 0.15s,color 0.15s;"
                       onmouseover="this.style.background='rgba(255,255,255,0.04)';this.style.color='#71717a';"
                       onmouseout="this.style.background='transparent';this.style.color='#3f3f46';"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View Site
                    </a>
                </div>
            </nav>

            {{-- User footer --}}
            <div style="padding:12px 14px;border-top:1px solid #27272a;flex-shrink:0;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                    <div style="width:30px;height:30px;border-radius:50%;background:#1e1b4b;border:1px solid #3730a3;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#a5b4fc;flex-shrink:0;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div style="min-width:0;">
                        <div style="font-size:13px;font-weight:500;color:#e4e4e7;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
                        <div style="font-size:11px;color:#52525b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            style="display:flex;align-items:center;gap:6px;font-size:12px;color:#52525b;background:none;border:none;cursor:pointer;padding:4px 6px;border-radius:6px;width:100%;transition:color 0.15s;"
                            onmouseover="this.style.color='#f87171';"
                            onmouseout="this.style.color='#52525b';">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Sign out
                    </button>
                </form>
            </div>
        </aside>

        {{-- ============================================================ --}}
        {{-- MAIN BODY                                                     --}}
        {{-- ============================================================ --}}
        <div id="admin-body">

            {{-- Topbar --}}
            <header style="height:56px;display:flex;align-items:center;padding:0 24px;gap:12px;border-bottom:1px solid #1f1f22;background:#09090b;position:sticky;top:0;z-index:30;flex-shrink:0;">

                {{-- Mobile hamburger --}}
                <button onclick="openSidebar()"
                        id="sidebar-toggle"
                        style="display:none;align-items:center;justify-content:center;width:34px;height:34px;border-radius:7px;border:none;background:transparent;color:#71717a;cursor:pointer;transition:background 0.15s,color 0.15s;"
                        onmouseover="this.style.background='#27272a';this.style.color='#f4f4f5';"
                        onmouseout="this.style.background='transparent';this.style.color='#71717a';"
                        aria-label="Open sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                {{-- Breadcrumb / Title --}}
                <div style="flex:1;">
                    <div style="display:flex;align-items:center;gap:6px;">
                        <span style="font-size:13px;color:#52525b;font-weight:500;">Admin</span>
                        <span style="color:#3f3f46;font-size:13px;">/</span>
                        <span style="font-size:13px;font-weight:600;color:#e4e4e7;">{{ $title ?? 'Dashboard' }}</span>
                    </div>
                </div>

                {{-- Date --}}
                <div style="font-size:12px;color:#3f3f46;font-weight:500;white-space:nowrap;">
                    {{ now()->format('d M Y') }}
                </div>
            </header>

            {{-- Flash messages --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-cloak
                     style="margin:16px 24px 0;display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:9px;background:rgba(16,185,129,0.08);border:1px solid rgba(16,185,129,0.2);font-size:13px;color:#6ee7b7;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                    <button @click="show=false" style="margin-left:auto;background:none;border:none;cursor:pointer;color:#34d399;" aria-label="Dismiss">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div style="margin:16px 24px 0;padding:12px 16px;border-radius:9px;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.2);">
                    <p style="font-size:12px;font-weight:600;color:#fca5a5;margin-bottom:6px;">Please fix the following errors:</p>
                    <ul style="list-style:disc;padding-left:16px;font-size:12px;color:#fca5a5;line-height:1.7;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Page content --}}
            <main style="flex:1;padding:24px;overflow-y:auto;">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Mobile sidebar JS (no Alpine dependency) --}}
    <script>
        var sidebar  = document.getElementById('admin-sidebar');
        var backdrop = document.getElementById('mobile-backdrop');
        var toggle   = document.getElementById('sidebar-toggle');

        function openSidebar() {
            sidebar.classList.add('open');
            backdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            backdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Show toggle only on mobile
        function checkBreakpoint() {
            if (window.innerWidth < 1024) {
                toggle.style.display = 'flex';
            } else {
                toggle.style.display = 'none';
                sidebar.classList.remove('open');
                backdrop.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        checkBreakpoint();
        window.addEventListener('resize', checkBreakpoint);

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeSidebar();
        });
    </script>

</body>
</html>

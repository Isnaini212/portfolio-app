<x-admin-layout title="Dashboard">

    {{-- Stats row --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;margin-bottom:28px;">

        @php
            $cards = [
                ['label' => 'Projects',         'value' => $stats['total_projects'],    'sub' => 'total entries',       'color' => '#6366f1'],
                ['label' => 'Featured',          'value' => $stats['featured_projects'], 'sub' => 'on homepage',         'color' => '#eab308'],
                ['label' => 'Learning Logs',     'value' => $stats['total_logs'],        'sub' => 'total entries',       'color' => '#a855f7'],
                ['label' => 'Categories',        'value' => $stats['total_categories'],  'sub' => 'active',              'color' => '#06b6d4'],
            ];
        @endphp

        @foreach($cards as $card)
            <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;padding:20px 22px;position:relative;overflow:hidden;">
                <div style="position:absolute;top:0;left:0;width:3px;height:100%;background:{{ $card['color'] }};border-radius:10px 0 0 10px;opacity:0.7;"></div>
                <div style="font-size:28px;font-weight:700;color:#f4f4f5;line-height:1;margin-bottom:6px;">
                    {{ $card['value'] }}
                </div>
                <div style="font-size:13px;font-weight:600;color:#a1a1aa;">{{ $card['label'] }}</div>
                <div style="font-size:11px;color:#3f3f46;margin-top:2px;">{{ $card['sub'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Two column: Recent Projects + Recent Logs --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

        {{-- Recent Projects --}}
        <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;overflow:hidden;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid #1f1f22;">
                <span style="font-size:13px;font-weight:600;color:#e4e4e7;">Recent Projects</span>
                <a href="{{ route('admin.projects.create') }}"
                   style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:7px;background:#4f46e5;color:#fff;font-size:12px;font-weight:600;text-decoration:none;transition:background 0.15s;"
                   onmouseover="this.style.background='#4338ca';"
                   onmouseout="this.style.background='#4f46e5';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:12px;height:12px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add
                </a>
            </div>

            @forelse($recentProjects as $project)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:11px 18px;border-bottom:1px solid #1a1a1c;transition:background 0.1s;"
                     onmouseover="this.style.background='rgba(255,255,255,0.02)';"
                     onmouseout="this.style.background='transparent';">
                    <div style="min-width:0;">
                        <div style="font-size:13px;font-weight:500;color:#d4d4d8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:180px;">{{ $project->title }}</div>
                        <div style="font-size:11px;color:#52525b;margin-top:1px;">{{ $project->category?->name ?? '—' }}</div>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;margin-left:10px;">
                        @if($project->is_featured)
                            <span style="padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;background:rgba(234,179,8,0.1);border:1px solid rgba(234,179,8,0.2);color:#ca8a04;">Featured</span>
                        @endif
                        <a href="{{ route('admin.projects.edit', $project) }}"
                           style="font-size:12px;font-weight:500;color:#52525b;text-decoration:none;transition:color 0.15s;"
                           onmouseover="this.style.color='#818cf8';"
                           onmouseout="this.style.color='#52525b';">Edit</a>
                    </div>
                </div>
            @empty
                <div style="padding:32px;text-align:center;color:#3f3f46;font-size:13px;">No projects yet.</div>
            @endforelse

            <div style="padding:12px 18px;border-top:1px solid #1f1f22;">
                <a href="{{ route('admin.projects.index') }}"
                   style="font-size:12px;color:#52525b;text-decoration:none;transition:color 0.15s;"
                   onmouseover="this.style.color='#818cf8';"
                   onmouseout="this.style.color='#52525b';">View all projects &rarr;</a>
            </div>
        </div>

        {{-- Recent Logs --}}
        <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;overflow:hidden;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid #1f1f22;">
                <span style="font-size:13px;font-weight:600;color:#e4e4e7;">Recent Learning Logs</span>
                <a href="{{ route('admin.logs.create') }}"
                   style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:7px;background:#4f46e5;color:#fff;font-size:12px;font-weight:600;text-decoration:none;transition:background 0.15s;"
                   onmouseover="this.style.background='#4338ca';"
                   onmouseout="this.style.background='#4f46e5';">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:12px;height:12px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add
                </a>
            </div>

            @forelse($recentLogs as $log)
                @php
                    $statusStyle = match($log->status) {
                        'completed'   => 'background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#34d399;',
                        'in_progress' => 'background:rgba(234,179,8,0.1);border:1px solid rgba(234,179,8,0.2);color:#ca8a04;',
                        default       => 'background:rgba(6,182,212,0.1);border:1px solid rgba(6,182,212,0.2);color:#22d3ee;',
                    };
                    $statusLabel = match($log->status) {
                        'completed'   => 'Done',
                        'in_progress' => 'In Progress',
                        default       => 'Planning',
                    };
                @endphp
                <div style="display:flex;align-items:center;justify-content:space-between;padding:11px 18px;border-bottom:1px solid #1a1a1c;transition:background 0.1s;"
                     onmouseover="this.style.background='rgba(255,255,255,0.02)';"
                     onmouseout="this.style.background='transparent';">
                    <div style="min-width:0;">
                        <div style="font-size:13px;font-weight:500;color:#d4d4d8;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:180px;">{{ $log->title }}</div>
                        <div style="font-size:11px;color:#52525b;margin-top:1px;">{{ $log->learned_at->format('M d, Y') }}</div>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;margin-left:10px;">
                        <span style="padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;{{ $statusStyle }}">{{ $statusLabel }}</span>
                        <a href="{{ route('admin.logs.edit', $log) }}"
                           style="font-size:12px;font-weight:500;color:#52525b;text-decoration:none;transition:color 0.15s;"
                           onmouseover="this.style.color='#818cf8';"
                           onmouseout="this.style.color='#52525b';">Edit</a>
                    </div>
                </div>
            @empty
                <div style="padding:32px;text-align:center;color:#3f3f46;font-size:13px;">No logs yet.</div>
            @endforelse

            <div style="padding:12px 18px;border-top:1px solid #1f1f22;">
                <a href="{{ route('admin.logs.index') }}"
                   style="font-size:12px;color:#52525b;text-decoration:none;transition:color 0.15s;"
                   onmouseover="this.style.color='#818cf8';"
                   onmouseout="this.style.color='#52525b';">View all logs &rarr;</a>
            </div>
        </div>
    </div>

    {{-- Responsive: stack on small screens --}}
    <style>
        @media (max-width: 767px) {
            #dashboard-grid { grid-template-columns: 1fr !important; }
        }
    </style>

</x-admin-layout>

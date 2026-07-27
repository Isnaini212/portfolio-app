<x-admin-layout title="Learning Logs">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <div>
            <h2 style="font-size:16px;font-weight:600;color:#f4f4f5;margin:0 0 2px;">Learning Logs</h2>
            <p style="font-size:12px;color:#52525b;margin:0;">{{ $logs->total() }} total entries</p>
        </div>
        <a href="{{ route('admin.logs.create') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px;background:#4f46e5;color:#fff;font-size:13px;font-weight:600;text-decoration:none;transition:background 0.15s;"
           onmouseover="this.style.background='#4338ca';"
           onmouseout="this.style.background='#4f46e5';">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add Log
        </a>
    </div>

    <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;overflow:hidden;">
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        @php
                            $statusStyle = match($log->status) {
                                'completed'   => 'background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#34d399;',
                                'in_progress' => 'background:rgba(234,179,8,0.1);border:1px solid rgba(234,179,8,0.2);color:#ca8a04;',
                                default       => 'background:rgba(6,182,212,0.1);border:1px solid rgba(6,182,212,0.2);color:#22d3ee;',
                            };
                            $statusLabel = match($log->status) {
                                'completed'   => 'Completed',
                                'in_progress' => 'In Progress',
                                default       => 'Planning',
                            };
                        @endphp
                        <tr>
                            <td>
                                <div style="font-weight:500;color:#d4d4d8;max-width:240px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $log->title }}</div>
                                <div style="font-size:11px;color:#3f3f46;font-family:monospace;margin-top:2px;">{{ $log->slug }}</div>
                            </td>
                            <td>
                                <span style="padding:3px 8px;border-radius:5px;font-size:11px;font-weight:500;background:#18181b;border:1px solid #27272a;color:#71717a;">
                                    {{ $log->category?->name ?? '—' }}
                                </span>
                            </td>
                            <td>
                                <span style="padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;{{ $statusStyle }}">{{ $statusLabel }}</span>
                            </td>
                            <td>
                                <span style="font-size:12px;color:#52525b;white-space:nowrap;">{{ $log->learned_at->format('M d, Y') }}</span>
                            </td>
                            <td style="text-align:right;">
                                <div style="display:inline-flex;align-items:center;gap:14px;">
                                    <a href="{{ route('admin.logs.edit', $log) }}"
                                       style="font-size:12px;font-weight:500;color:#52525b;text-decoration:none;transition:color 0.15s;"
                                       onmouseover="this.style.color='#818cf8';"
                                       onmouseout="this.style.color='#52525b';">Edit</a>
                                    <form action="{{ route('admin.logs.destroy', $log) }}" method="POST"
                                          onsubmit="return confirm('Delete this log?')" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                style="font-size:12px;font-weight:500;color:#3f3f46;background:none;border:none;cursor:pointer;padding:0;transition:color 0.15s;"
                                                onmouseover="this.style.color='#f87171';"
                                                onmouseout="this.style.color='#3f3f46';">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:48px;color:#3f3f46;font-size:13px;">
                                No logs yet.
                                <a href="{{ route('admin.logs.create') }}" style="color:#818cf8;text-decoration:none;margin-left:4px;">Add one.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
            <div style="padding:14px 18px;border-top:1px solid #1f1f22;">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

</x-admin-layout>

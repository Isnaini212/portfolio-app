<x-admin-layout title="Projects">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <div>
            <h2 style="font-size:16px;font-weight:600;color:#f4f4f5;margin:0 0 2px;">Projects</h2>
            <p style="font-size:12px;color:#52525b;margin:0;">{{ $projects->total() }} total entries</p>
        </div>
        <a href="{{ route('admin.projects.create') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px;background:#4f46e5;color:#fff;font-size:13px;font-weight:600;text-decoration:none;transition:background 0.15s;"
           onmouseover="this.style.background='#4338ca';"
           onmouseout="this.style.background='#4f46e5';">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add Project
        </a>
    </div>

    <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;overflow:hidden;">
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tech Stack</th>
                        <th>Featured</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>
                                <div style="font-weight:500;color:#d4d4d8;max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $project->title }}</div>
                                <div style="font-size:11px;color:#3f3f46;font-family:monospace;margin-top:2px;">{{ $project->slug }}</div>
                            </td>
                            <td>
                                <span style="padding:3px 8px;border-radius:5px;font-size:11px;font-weight:500;background:#18181b;border:1px solid #27272a;color:#71717a;">
                                    {{ $project->category?->name ?? '—' }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size:12px;color:#52525b;max-width:160px;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                    {{ $project->tech_stack }}
                                </span>
                            </td>
                            <td>
                                @if($project->is_featured)
                                    <span style="padding:2px 8px;border-radius:20px;font-size:10px;font-weight:600;background:rgba(234,179,8,0.1);border:1px solid rgba(234,179,8,0.2);color:#ca8a04;">Yes</span>
                                @else
                                    <span style="color:#3f3f46;font-size:13px;">—</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <div style="display:inline-flex;align-items:center;gap:14px;">
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                       style="font-size:12px;font-weight:500;color:#52525b;text-decoration:none;transition:color 0.15s;"
                                       onmouseover="this.style.color='#818cf8';"
                                       onmouseout="this.style.color='#52525b';">Edit</a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                          onsubmit="return confirm('Delete this project?')" style="margin:0;">
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
                                No projects yet.
                                <a href="{{ route('admin.projects.create') }}" style="color:#818cf8;text-decoration:none;margin-left:4px;">Add one.</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($projects->hasPages())
            <div style="padding:14px 18px;border-top:1px solid #1f1f22;">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

</x-admin-layout>

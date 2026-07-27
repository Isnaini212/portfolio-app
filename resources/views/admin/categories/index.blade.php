<x-admin-layout title="Categories">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
        <div>
            <h2 style="font-size:16px;font-weight:600;color:#f4f4f5;margin:0 0 2px;">Categories</h2>
            <p style="font-size:12px;color:#52525b;margin:0;">{{ $categories->total() }} total</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px;background:#4f46e5;color:#fff;font-size:13px;font-weight:600;text-decoration:none;transition:background 0.15s;"
           onmouseover="this.style.background='#4338ca';"
           onmouseout="this.style.background='#4f46e5';">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:13px;height:13px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add Category
        </a>
    </div>

    <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;overflow:hidden;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Projects</th>
                    <th>Logs</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td style="font-weight:500;color:#d4d4d8;">{{ $category->name }}</td>
                        <td style="font-family:monospace;font-size:12px;color:#52525b;">{{ $category->slug }}</td>
                        <td>
                            <span style="padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;background:rgba(99,102,241,0.1);border:1px solid rgba(99,102,241,0.2);color:#818cf8;">
                                {{ $category->projects_count }}
                            </span>
                        </td>
                        <td>
                            <span style="padding:2px 8px;border-radius:20px;font-size:11px;font-weight:600;background:rgba(168,85,247,0.1);border:1px solid rgba(168,85,247,0.2);color:#c084fc;">
                                {{ $category->learning_logs_count }}
                            </span>
                        </td>
                        <td style="text-align:right;">
                            <div style="display:inline-flex;align-items:center;gap:14px;">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   style="font-size:12px;font-weight:500;color:#52525b;text-decoration:none;transition:color 0.15s;"
                                   onmouseover="this.style.color='#818cf8';"
                                   onmouseout="this.style.color='#52525b';">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                      onsubmit="return confirm('Delete this category? Projects and logs in this category will also be deleted.')"
                                      style="margin:0;">
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
                            No categories yet.
                            <a href="{{ route('admin.categories.create') }}" style="color:#818cf8;text-decoration:none;margin-left:4px;">Add one.</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($categories->hasPages())
            <div style="padding:14px 18px;border-top:1px solid #1f1f22;">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

</x-admin-layout>

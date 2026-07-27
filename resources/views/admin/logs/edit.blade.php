<x-admin-layout title="Edit Learning Log">

    <div style="max-width:640px;">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
            <a href="{{ route('admin.logs.index') }}"
               style="display:flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:7px;border:1px solid #27272a;color:#52525b;text-decoration:none;transition:border-color 0.15s,color 0.15s;"
               onmouseover="this.style.borderColor='#3f3f46';this.style.color='#d4d4d8';"
               onmouseout="this.style.borderColor='#27272a';this.style.color='#52525b';">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 style="font-size:15px;font-weight:600;color:#f4f4f5;margin:0;">Edit Learning Log</h2>
        </div>

        <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;padding:24px;">
            <form action="{{ route('admin.logs.update', $log) }}" method="POST">
                @csrf
                @method('PATCH')

                @include('admin.logs._form', ['log' => $log, 'categories' => $categories, 'statuses' => $statuses])

                <div style="display:flex;align-items:center;gap:10px;padding-top:6px;border-top:1px solid #1f1f22;margin-top:6px;">
                    <button type="submit"
                            style="padding:9px 18px;border-radius:8px;background:#4f46e5;color:#fff;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background 0.15s;"
                            onmouseover="this.style.background='#4338ca';"
                            onmouseout="this.style.background='#4f46e5';">
                        Update Log
                    </button>
                    <a href="{{ route('admin.logs.index') }}"
                       style="padding:9px 18px;border-radius:8px;background:#18181b;border:1px solid #27272a;color:#71717a;font-size:13px;font-weight:500;text-decoration:none;transition:border-color 0.15s,color 0.15s;"
                       onmouseover="this.style.borderColor='#3f3f46';this.style.color='#a1a1aa';"
                       onmouseout="this.style.borderColor='#27272a';this.style.color='#71717a';">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>

{{-- Shared learning log form fields --}}

@php
    $old = fn(string $field, $default = '') => old($field, $log?->{$field} ?? $default);

    $inputStyle = 'width:100%;background:#18181b;border:1px solid #3f3f46;border-radius:8px;padding:9px 14px;font-size:13px;color:#f4f4f5;outline:none;font-family:inherit;box-sizing:border-box;transition:border-color 0.15s;';
    $labelStyle = 'display:block;font-size:11px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#52525b;margin-bottom:6px;';
    $errorStyle = 'font-size:11px;color:#f87171;margin-top:4px;display:block;';
    $groupStyle = 'margin-bottom:18px;';
@endphp

<div x-data="{
    title: '{{ e($old('title')) }}',
    slug:  '{{ e($old('slug')) }}',
    slugEdited: {{ $log ? 'true' : 'false' }}
}">

    {{-- Title --}}
    <div style="{{ $groupStyle }}">
        <label for="title" style="{{ $labelStyle }}">Title <span style="color:#f87171;">*</span></label>
        <input type="text" id="title" name="title"
               x-model="title"
               @input="if (!slugEdited) slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '')"
               placeholder="Learning about Laravel Queues"
               class="admin-input"
               style="{{ $inputStyle }} {{ $errors->has('title') ? 'border-color:#f87171;' : '' }}"
               required>
        @error('title') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Slug --}}
    <div style="{{ $groupStyle }}">
        <label for="slug" style="{{ $labelStyle }}">Slug <span style="color:#f87171;">*</span></label>
        <input type="text" id="slug" name="slug"
               x-model="slug"
               @input="slugEdited = true"
               placeholder="learning-about-laravel-queues"
               class="admin-input"
               style="{{ $inputStyle }} font-family:monospace; {{ $errors->has('slug') ? 'border-color:#f87171;' : '' }}"
               required>
        @error('slug') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Category --}}
    <div style="{{ $groupStyle }}">
        <label for="category_id" style="{{ $labelStyle }}">Category <span style="color:#f87171;">*</span></label>
        <select id="category_id" name="category_id" class="admin-input"
                style="{{ $inputStyle }} {{ $errors->has('category_id') ? 'border-color:#f87171;' : '' }}"
                required>
            <option value="">-- Select category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $old('category_id', $log?->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Status + Date --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px;">
        <div>
            <label for="status" style="{{ $labelStyle }}">Status <span style="color:#f87171;">*</span></label>
            <select id="status" name="status" class="admin-input"
                    style="{{ $inputStyle }} {{ $errors->has('status') ? 'border-color:#f87171;' : '' }}"
                    required>
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $old('status', $log?->status ?? 'in_progress') === $status ? 'selected' : '' }}>
                        {{ ucwords(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
            @error('status') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="learned_at" style="{{ $labelStyle }}">Date Learned <span style="color:#f87171;">*</span></label>
            <input type="date" id="learned_at" name="learned_at"
                   value="{{ $old('learned_at', $log?->learned_at?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                   class="admin-input"
                   style="{{ $inputStyle }} color-scheme:dark; {{ $errors->has('learned_at') ? 'border-color:#f87171;' : '' }}"
                   required>
            @error('learned_at') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Content --}}
    <div style="{{ $groupStyle }}">
        <label for="content" style="{{ $labelStyle }}">Content <span style="color:#f87171;">*</span></label>
        <textarea id="content" name="content" rows="6"
                  placeholder="What did you learn? Key takeaways, resources, challenges..."
                  class="admin-input"
                  style="{{ $inputStyle }} resize:vertical; {{ $errors->has('content') ? 'border-color:#f87171;' : '' }}"
                  required>{{ $old('content') }}</textarea>
        @error('content') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

</div>

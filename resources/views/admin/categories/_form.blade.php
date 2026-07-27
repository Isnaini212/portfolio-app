{{-- Shared category form fields --}}

@php
    $old = fn(string $field, $default = '') => old($field, $category?->{$field} ?? $default);

    $inputStyle = 'width:100%;background:#18181b;border:1px solid #3f3f46;border-radius:8px;padding:9px 14px;font-size:13px;color:#f4f4f5;outline:none;font-family:inherit;box-sizing:border-box;transition:border-color 0.15s;';
    $labelStyle = 'display:block;font-size:11px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#52525b;margin-bottom:6px;';
    $errorStyle = 'font-size:11px;color:#f87171;margin-top:4px;display:block;';
    $groupStyle = 'margin-bottom:18px;';
@endphp

<div x-data="{
    name: '{{ e($old('name')) }}',
    slug: '{{ e($old('slug')) }}',
    slugEdited: {{ $category ? 'true' : 'false' }}
}">

    <div style="{{ $groupStyle }}">
        <label for="name" style="{{ $labelStyle }}">Name <span style="color:#f87171;">*</span></label>
        <input type="text" id="name" name="name"
               x-model="name"
               @input="if (!slugEdited) slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '')"
               placeholder="Laravel"
               class="admin-input"
               style="{{ $inputStyle }} {{ $errors->has('name') ? 'border-color:#f87171;' : '' }}"
               required>
        @error('name') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    <div style="{{ $groupStyle }}">
        <label for="slug" style="{{ $labelStyle }}">Slug <span style="color:#f87171;">*</span></label>
        <input type="text" id="slug" name="slug"
               x-model="slug"
               @input="slugEdited = true"
               placeholder="laravel"
               class="admin-input"
               style="{{ $inputStyle }} font-family:monospace; {{ $errors->has('slug') ? 'border-color:#f87171;' : '' }}"
               required>
        @error('slug') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

</div>

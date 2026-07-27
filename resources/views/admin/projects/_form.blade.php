{{-- Shared project form fields --}}

@php
    $old = fn(string $field, $default = '') => old($field, $project?->{$field} ?? $default);

    $inputStyle = 'width:100%;background:#18181b;border:1px solid #3f3f46;border-radius:8px;padding:9px 14px;font-size:13px;color:#f4f4f5;outline:none;font-family:inherit;box-sizing:border-box;transition:border-color 0.15s;';
    $labelStyle = 'display:block;font-size:11px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#52525b;margin-bottom:6px;';
    $errorStyle = 'font-size:11px;color:#f87171;margin-top:4px;display:block;';
    $groupStyle = 'margin-bottom:18px;';
@endphp

<div x-data="{
    title: '{{ e($old('title')) }}',
    slug:  '{{ e($old('slug')) }}',
    slugEdited: {{ $project ? 'true' : 'false' }},
    preview: '{{ $project?->image ? Storage::url($project->image) : '' }}',
    showNewCategory: false,
    newCategoryName: '',
    isSavingCategory: false,
    categories: {{ Js::from($categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])) }},
    selectedCategory: {{ old('category_id', $project?->category_id) ?: 'null' }},
    async saveCategory() {
        if (!this.newCategoryName.trim()) return;
        this.isSavingCategory = true;
        try {
            let res = await fetch('{{ route("admin.categories.quickAdd") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name: this.newCategoryName })
            });
            let data = await res.json();
            if (data.success) {
                this.categories.push({ id: data.category.id, name: data.category.name });
                // Sort categories by name alphabetically
                this.categories.sort((a, b) => a.name.localeCompare(b.name));
                this.selectedCategory = data.category.id;
                this.showNewCategory = false;
                this.newCategoryName = '';
            } else {
                alert('Error: ' + (data.message || 'Validation failed.'));
            }
        } catch(e) {
            alert('Failed to connect to the server.');
        }
        this.isSavingCategory = false;
    }
}">

    {{-- Title --}}
    <div style="{{ $groupStyle }}">
        <label for="title" style="{{ $labelStyle }}">Title <span style="color:#f87171;">*</span></label>
        <input type="text" id="title" name="title"
               x-model="title"
               @input="if (!slugEdited) slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '')"
               placeholder="My Awesome Project"
               style="{{ $inputStyle }} {{ $errors->has('title') ? 'border-color:#f87171;' : '' }}"
               class="admin-input"
               required>
        @error('title') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Slug --}}
    <div style="{{ $groupStyle }}">
        <label for="slug" style="{{ $labelStyle }}">Slug <span style="color:#f87171;">*</span></label>
        <input type="text" id="slug" name="slug"
               x-model="slug"
               @input="slugEdited = true"
               placeholder="my-awesome-project"
               style="{{ $inputStyle }} font-family:monospace; {{ $errors->has('slug') ? 'border-color:#f87171;' : '' }}"
               class="admin-input"
               required>
        @error('slug') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Category --}}
    <div style="{{ $groupStyle }}">
        <label style="{{ $labelStyle }}">Category <span style="color:#f87171;">*</span></label>
        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
            <template x-for="cat in categories" :key="cat.id">
                <label style="cursor:pointer;" x-show="!showNewCategory">
                    <input type="radio" name="category_id" :value="cat.id" x-model="selectedCategory"
                           class="peer" style="display:none;" :disabled="showNewCategory">
                    <div class="px-4 py-2.5 rounded-full border border-zinc-700 bg-zinc-900 text-zinc-400 text-xs font-medium peer-checked:border-indigo-500 peer-checked:bg-indigo-600/20 peer-checked:text-indigo-300 transition-colors"
                         x-text="cat.name">
                    </div>
                </label>
            </template>
            
            <button type="button" 
                    @click="showNewCategory = !showNewCategory"
                    x-text="showNewCategory ? 'Cancel' : '+ Add New'"
                    style="border: 1px dashed #3f3f46; background: transparent; color: #a1a1aa; border-radius: 9999px; padding: 7px 14px; font-size: 12px; cursor: pointer; transition: 0.2s;"
                    onmouseover="this.style.borderColor='#6366f1'; this.style.color='#6366f1';"
                    onmouseout="this.style.borderColor='#3f3f46'; this.style.color='#a1a1aa';">
            </button>
        </div>
        
        <div x-show="showNewCategory" x-transition style="margin-top: 10px; display: flex; gap: 10px;">
            <input type="text" x-model="newCategoryName" placeholder="Enter new category name..."
                   class="admin-input" style="{{ $inputStyle }} max-width: 300px;"
                   :disabled="!showNewCategory" @keydown.enter.prevent="saveCategory">
            <button type="button" @click="saveCategory" :disabled="isSavingCategory"
                    style="padding:9px 16px;border-radius:8px;background:#10b981;color:#fff;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background 0.15s; display:flex; align-items:center; gap:6px;"
                    onmouseover="this.style.background='#059669';"
                    onmouseout="this.style.background='#10b981';">
                <span x-show="!isSavingCategory">Save Category</span>
                <span x-show="isSavingCategory">Saving...</span>
            </button>
        </div>

        @error('category_id') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Project Type --}}
    <div style="{{ $groupStyle }}">
        <label style="{{ $labelStyle }}">Project Type <span style="color:#f87171;">*</span></label>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <label style="cursor:pointer;">
                <input type="radio" name="collaboration_type" value="solo"
                       {{ $old('collaboration_type', $project?->collaboration_type ?? 'solo') == 'solo' ? 'checked' : '' }}
                       class="peer" style="display:none;" required>
                <div class="px-4 py-2.5 rounded-full border border-zinc-700 bg-zinc-900 text-zinc-400 text-xs font-medium peer-checked:border-sky-500 peer-checked:bg-sky-600/20 peer-checked:text-sky-300 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Solo Project
                </div>
            </label>
            <label style="cursor:pointer;">
                <input type="radio" name="collaboration_type" value="team"
                       {{ $old('collaboration_type', $project?->collaboration_type) == 'team' ? 'checked' : '' }}
                       class="peer" style="display:none;" required>
                <div class="px-4 py-2.5 rounded-full border border-zinc-700 bg-zinc-900 text-zinc-400 text-xs font-medium peer-checked:border-emerald-500 peer-checked:bg-emerald-600/20 peer-checked:text-emerald-300 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    Team Project
                </div>
            </label>
        </div>
        @error('collaboration_type') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Description --}}
    <div style="{{ $groupStyle }}">
        <label for="description" style="{{ $labelStyle }}">Description <span style="color:#f87171;">*</span></label>
        <textarea id="description" name="description" rows="4"
                  placeholder="Describe the project..."
                  class="admin-input"
                  style="{{ $inputStyle }} resize:vertical; {{ $errors->has('description') ? 'border-color:#f87171;' : '' }}"
                  required>{{ $old('description') }}</textarea>
        @error('description') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Tech Stack --}}
    <div style="{{ $groupStyle }}">
        <label for="tech_stack" style="{{ $labelStyle }}">Tech Stack <span style="color:#f87171;">*</span></label>
        <input type="text" id="tech_stack" name="tech_stack"
               value="{{ $old('tech_stack') }}"
               placeholder="Laravel, Tailwind CSS, Alpine.js"
               class="admin-input"
               style="{{ $inputStyle }} {{ $errors->has('tech_stack') ? 'border-color:#f87171;' : '' }}"
               required>
        <span style="font-size:11px;color:#3f3f46;margin-top:4px;display:block;">Separate technologies with commas.</span>
        @error('tech_stack') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- URLs --}}
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px;">
        <div>
            <label for="github_url" style="{{ $labelStyle }}">GitHub URL</label>
            <input type="url" id="github_url" name="github_url"
                   value="{{ $old('github_url') }}"
                   placeholder="https://github.com/..."
                   class="admin-input"
                   style="{{ $inputStyle }} {{ $errors->has('github_url') ? 'border-color:#f87171;' : '' }}">
            @error('github_url') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="demo_url" style="{{ $labelStyle }}">Demo URL</label>
            <input type="url" id="demo_url" name="demo_url"
                   value="{{ $old('demo_url') }}"
                   placeholder="https://..."
                   class="admin-input"
                   style="{{ $inputStyle }} {{ $errors->has('demo_url') ? 'border-color:#f87171;' : '' }}">
            @error('demo_url') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Image upload --}}
    <div style="{{ $groupStyle }}">
        <label for="image" style="{{ $labelStyle }}">Project Image</label>

        <template x-if="preview">
            <div style="margin-bottom:10px;">
                <img :src="preview" alt="Preview" style="height:100px;border-radius:8px;border:1px solid #27272a;object-fit:cover;">
            </div>
        </template>

        <input type="file" id="image" name="image" accept="image/*"
               @change="preview = URL.createObjectURL($event.target.files[0])"
               style="font-size:13px;color:#71717a;width:100%;cursor:pointer;">
        <span style="font-size:11px;color:#3f3f46;margin-top:4px;display:block;">JPG, PNG, WebP — max 2 MB. Leave empty to keep existing image.</span>
        @error('image') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
    </div>

    {{-- Featured toggle --}}
    <div style="display:flex;align-items:flex-start;gap:10px;padding:14px 16px;background:#18181b;border:1px solid #27272a;border-radius:9px;margin-bottom:18px;">
        <input type="hidden" name="is_featured" value="0">
        <input type="checkbox" id="is_featured" name="is_featured" value="1"
               {{ $old('is_featured', $project?->is_featured) ? 'checked' : '' }}
               style="width:15px;height:15px;margin-top:2px;cursor:pointer;accent-color:#6366f1;flex-shrink:0;">
        <label for="is_featured" style="cursor:pointer;font-size:13px;font-weight:500;color:#a1a1aa;line-height:1.4;">
            Mark as Featured Project
            <span style="display:block;font-size:11px;color:#52525b;font-weight:400;margin-top:2px;">Featured projects appear on the home page.</span>
        </label>
    </div>

</div>

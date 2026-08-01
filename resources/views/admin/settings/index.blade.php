<x-admin-layout title="Site Settings">

    <div style="max-width:640px;">

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
            <div>
                <h2 style="font-size:16px;font-weight:600;color:#f4f4f5;margin:0 0 2px;">Hero &amp; Site Settings</h2>
                <p style="font-size:12px;color:#52525b;margin:0;">Customize text and headlines displayed on the home page hero section.</p>
            </div>
            <button type="submit" form="settings-form"
                    style="padding:9px 18px;border-radius:8px;background:#4f46e5;color:#fff;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background 0.15s;"
                    onmouseover="this.style.background='#4338ca';"
                    onmouseout="this.style.background='#4f46e5';">
                Save Settings
            </button>
        </div>

        <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;padding:24px;">
            <form id="settings-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @php
                    $inputStyle = 'width:100%;background:#18181b;border:1px solid #3f3f46;border-radius:8px;padding:9px 14px;font-size:13px;color:#f4f4f5;outline:none;font-family:inherit;box-sizing:border-box;transition:border-color 0.15s;';
                    $labelStyle = 'display:block;font-size:11px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#52525b;margin-bottom:6px;';
                    $errorStyle = 'font-size:11px;color:#f87171;margin-top:4px;display:block;';
                    $groupStyle = 'margin-bottom:20px;';
                @endphp

                {{-- Preloader Text --}}
                <div style="{{ $groupStyle }}">
                    <label for="preloader_text" style="{{ $labelStyle }}">Preloader Intro Text <span style="color:#f87171;">*</span></label>
                    <input type="text" id="preloader_text" name="preloader_text"
                           value="{{ old('preloader_text', $settings['preloader_text']) }}"
                           placeholder="WELCOME TO MY PORTFOLIO"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('preloader_text') ? 'border-color:#f87171;' : '' }}"
                           required>
                    <span style="font-size:11px;color:#3f3f46;margin-top:4px;display:block;">Text shown on the full-screen intro preloader screen before the page loads.</span>
                    @error('preloader_text') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- Status Badge --}}
                <div style="{{ $groupStyle }}">
                    <label for="hero_status_badge" style="{{ $labelStyle }}">Status Badge Text <span style="color:#f87171;">*</span></label>
                    <input type="text" id="hero_status_badge" name="hero_status_badge"
                           value="{{ old('hero_status_badge', $settings['hero_status_badge']) }}"
                           placeholder="Open to work"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('hero_status_badge') ? 'border-color:#f87171;' : '' }}"
                           required>
                    <span style="font-size:11px;color:#3f3f46;margin-top:4px;display:block;">Top-left badge pill text.</span>
                    @error('hero_status_badge') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- Sub Badge --}}
                <div style="{{ $groupStyle }}">
                    <label for="hero_sub_badge" style="{{ $labelStyle }}">Top Tagline Text <span style="color:#f87171;">*</span></label>
                    <input type="text" id="hero_sub_badge" name="hero_sub_badge"
                           value="{{ old('hero_sub_badge', $settings['hero_sub_badge']) }}"
                           placeholder="Building & learning in public"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('hero_sub_badge') ? 'border-color:#f87171;' : '' }}"
                           required>
                    <span style="font-size:11px;color:#3f3f46;margin-top:4px;display:block;">Top-right sub text next to status badge.</span>
                    @error('hero_sub_badge') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- Headline 1 --}}
                <div style="{{ $groupStyle }}">
                    <label for="hero_headline_1" style="{{ $labelStyle }}">Headline Line 1 <span style="color:#f87171;">*</span></label>
                    <input type="text" id="hero_headline_1" name="hero_headline_1"
                           value="{{ old('hero_headline_1', $settings['hero_headline_1']) }}"
                           placeholder="FULL-STACK"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('hero_headline_1') ? 'border-color:#f87171;' : '' }}"
                           required>
                    @error('hero_headline_1') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- Headline 2 --}}
                <div style="{{ $groupStyle }}">
                    <label for="hero_headline_2" style="{{ $labelStyle }}">Headline Line 2 <span style="color:#f87171;">*</span></label>
                    <input type="text" id="hero_headline_2" name="hero_headline_2"
                           value="{{ old('hero_headline_2', $settings['hero_headline_2']) }}"
                           placeholder="DEVELOPER"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('hero_headline_2') ? 'border-color:#f87171;' : '' }}"
                           required>
                    @error('hero_headline_2') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- Headline 3 --}}
                <div style="{{ $groupStyle }}">
                    <label for="hero_headline_3" style="{{ $labelStyle }}">Headline Line 3 <span style="color:#f87171;">*</span></label>
                    <input type="text" id="hero_headline_3" name="hero_headline_3"
                           value="{{ old('hero_headline_3', $settings['hero_headline_3']) }}"
                           placeholder="& DevLog"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('hero_headline_3') ? 'border-color:#f87171;' : '' }}"
                           required>
                    @error('hero_headline_3') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- Bio --}}
                <div style="{{ $groupStyle }}">
                    <label for="hero_bio" style="{{ $labelStyle }}">Hero Bio Paragraph <span style="color:#f87171;">*</span></label>
                    <textarea id="hero_bio" name="hero_bio" rows="3"
                              placeholder="Building performant web applications..."
                              class="admin-input"
                              style="{{ $inputStyle }} resize:vertical; {{ $errors->has('hero_bio') ? 'border-color:#f87171;' : '' }}"
                              required>{{ old('hero_bio', $settings['hero_bio']) }}</textarea>
                    @error('hero_bio') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- Contact Email --}}
                <div style="{{ $groupStyle }}">
                    <label for="hero_email" style="{{ $labelStyle }}">Contact Email <span style="color:#f87171;">*</span></label>
                    <input type="email" id="hero_email" name="hero_email"
                           value="{{ old('hero_email', $settings['hero_email']) }}"
                           placeholder="muhamadisnaini121@gmail.com"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('hero_email') ? 'border-color:#f87171;' : '' }}"
                           required>
                    @error('hero_email') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- Section Divider: Data Diri / Profile Identity --}}
                <div style="margin:30px 0 20px;padding-top:20px;border-top:1px solid #27272a;">
                    <h3 style="font-size:14px;font-weight:600;color:#818cf8;margin:0 0 4px;text-transform:uppercase;letter-spacing:0.05em;">Data Diri / Profile Identity</h3>
                    <p style="font-size:12px;color:#71717a;margin:0 0 16px;">Pengaturan kartu profil & banner slider data diri di halaman depan.</p>

                    {{-- Profile Name --}}
                    <div style="{{ $groupStyle }}">
                        <label for="profile_name" style="{{ $labelStyle }}">Nama Lengkap</label>
                        <input type="text" id="profile_name" name="profile_name"
                               value="{{ old('profile_name', $settings['profile_name']) }}"
                               placeholder="MUHAMAD ISNAINI SAPUTRA"
                               class="admin-input"
                               style="{{ $inputStyle }}">
                    </div>

                    {{-- Profile Role --}}
                    <div style="{{ $groupStyle }}">
                        <label for="profile_role" style="{{ $labelStyle }}">Role / Status Major</label>
                        <input type="text" id="profile_role" name="profile_role"
                               value="{{ old('profile_role', $settings['profile_role']) }}"
                               placeholder="MAHASISWA SISTEM INFORMASI"
                               class="admin-input"
                               style="{{ $inputStyle }}">
                    </div>

                    {{-- Profile Phone --}}
                    <div style="{{ $groupStyle }}">
                        <label for="profile_phone" style="{{ $labelStyle }}">Nomor Telepon / WhatsApp</label>
                        <input type="text" id="profile_phone" name="profile_phone"
                               value="{{ old('profile_phone', $settings['profile_phone']) }}"
                               placeholder="081282250402"
                               class="admin-input"
                               style="{{ $inputStyle }}">
                    </div>

                    {{-- Profile Location --}}
                    <div style="{{ $groupStyle }}">
                        <label for="profile_location" style="{{ $labelStyle }}">Lokasi / Domisili</label>
                        <input type="text" id="profile_location" name="profile_location"
                               value="{{ old('profile_location', $settings['profile_location']) }}"
                               placeholder="Tangerang, Banten"
                               class="admin-input"
                               style="{{ $inputStyle }}">
                    </div>

                    {{-- Profile Email --}}
                    <div style="{{ $groupStyle }}">
                        <label for="profile_email" style="{{ $labelStyle }}">Email Data Diri</label>
                        <input type="email" id="profile_email" name="profile_email"
                               value="{{ old('profile_email', $settings['profile_email']) }}"
                               placeholder="muhamadisnaini121@gmail.com"
                               class="admin-input"
                               style="{{ $inputStyle }}">
                    </div>

                    {{-- Profile GitHub --}}
                    <div style="{{ $groupStyle }}">
                        <label for="profile_github" style="{{ $labelStyle }}">URL / Username GitHub</label>
                        <input type="text" id="profile_github" name="profile_github"
                               value="{{ old('profile_github', $settings['profile_github']) }}"
                               placeholder="github.com/Isnaini212"
                               class="admin-input"
                               style="{{ $inputStyle }}">
                    </div>

                    {{-- Profile Website --}}
                    <div style="{{ $groupStyle }}">
                        <label for="profile_website" style="{{ $labelStyle }}">URL Website / Portfolio</label>
                        <input type="text" id="profile_website" name="profile_website"
                               value="{{ old('profile_website', $settings['profile_website']) }}"
                               placeholder="www.saputra.site.je"
                               class="admin-input"
                               style="{{ $inputStyle }}">
                    </div>

                    {{-- Profile Photo Upload & Management (Drag & Drop Zone) --}}
                    @php
                        $photoVal = $settings['profile_photo'] ?? 'images/profile-photo.png';
                        if (\Illuminate\Support\Str::startsWith($photoVal, ['http://', 'https://'])) {
                            $photoPreview = $photoVal;
                        } elseif (\Illuminate\Support\Str::startsWith($photoVal, ['images/', 'uploads/'])) {
                            $photoPreview = asset($photoVal);
                        } else {
                            $photoPreview = \Illuminate\Support\Facades\Storage::disk('public')->url($photoVal);
                        }
                        $photoPreview .= '?v=' . time();
                    @endphp

                    <div
                        x-data="{
                            isDragging: false,
                            previewUrl: '{{ $photoPreview }}',
                            fileName: '',
                            handleDrop(e) {
                                const files = e.dataTransfer.files;
                                if (files.length > 0) {
                                    const file = files[0];
                                    if (file.type.startsWith('image/')) {
                                        const input = $refs.fileInput;
                                        const dataTransfer = new DataTransfer();
                                        dataTransfer.items.add(file);
                                        input.files = dataTransfer.files;
                                        this.fileName = file.name;
                                        this.previewUrl = URL.createObjectURL(file);
                                    }
                                }
                                this.isDragging = false;
                            },
                            handleFileSelect(e) {
                                const files = e.target.files;
                                if (files.length > 0) {
                                    const file = files[0];
                                    this.fileName = file.name;
                                    this.previewUrl = URL.createObjectURL(file);
                                }
                            }
                        }"
                        style="{{ $groupStyle }};background:#18181b;border:1px solid #27272a;border-radius:12px;padding:20px;"
                    >
                        <label style="{{ $labelStyle }};color:#818cf8;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between;">
                            <span>Foto Profil Diri (Drag &amp; Drop / Upload)</span>
                            <span style="font-size:10px;color:#a1a1aa;font-weight:normal;">JPG, PNG, WEBP, GIF max 4MB</span>
                        </label>

                        {{-- Drag & Drop Dropzone Box --}}
                        <div
                            @dragover.prevent="isDragging = true"
                            @dragleave.prevent="isDragging = false"
                            @drop.prevent="handleDrop($event)"
                            @click="$refs.fileInput.click()"
                            :style="isDragging 
                                ? 'border:2px dashed #6366f1;background:rgba(99,102,241,0.15);box-shadow:0 0 20px rgba(99,102,241,0.3);' 
                                : 'border:2px dashed #3f3f46;background:#09090b;'"
                            style="border-radius:12px;padding:24px;text-align:center;cursor:pointer;transition:all 0.2s ease-in-out;position:relative;"
                        >
                            <input
                                type="file"
                                x-ref="fileInput"
                                name="profile_photo_file"
                                accept="image/*"
                                style="display:none;"
                                @change="handleFileSelect($event)"
                            >

                            <div style="display:flex;flex-direction:column;align-items:center;gap:12px;">
                                {{-- Live Preview Thumbnail --}}
                                <div style="width:96px;height:96px;border-radius:12px;overflow:hidden;background:#18181b;border:2px solid #4f46e5;box-shadow:0 4px 14px rgba(0,0,0,0.6);position:relative;">
                                    <img :src="previewUrl" alt="Preview Foto Diri" style="width:100%;height:100%;object-fit:cover;object-position:top;" />
                                </div>

                                <div>
                                    <p style="font-size:13px;font-weight:600;color:#f4f4f5;margin:0 0 4px;">
                                        <span x-text="isDragging ? 'Lepaskan foto di sini...' : 'Tarik &amp; Lepaskan foto ke sini'"></span>
                                    </p>
                                    <p style="font-size:11px;color:#71717a;margin:0 0 8px;">
                                        atau <span style="color:#818cf8;text-decoration:underline;font-weight:600;">Klik di sini untuk memilih file</span>
                                    </p>
                                    <template x-if="fileName">
                                        <div style="display:flex;align-items:center;gap:10px;margin-top:10px;flex-wrap:wrap;justify-content:center;" @click.stop="">
                                            <span style="display:inline-block;padding:5px 12px;border-radius:6px;background:#312e81;color:#c7d2fe;font-size:11px;font-weight:600;" x-text="'Terpilih: ' + fileName"></span>
                                            <button type="submit" form="settings-form" style="padding:6px 14px;border-radius:6px;background:#22c55e;color:#fff;font-size:12px;font-weight:600;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(34,197,94,0.3);transition:background 0.15s;" onmouseover="this.style.background='#16a34a';" onmouseout="this.style.background='#22c55e';">
                                                Simpan Foto Sekarang
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- Reset / Remove Photo Option --}}
                        <div style="margin-top:14px;padding-top:12px;border-top:1px solid #27272a;display:flex;align-items:center;gap:8px;">
                            <input type="checkbox" id="remove_profile_photo" name="remove_profile_photo" value="1" style="cursor:pointer;accent-color:#ef4444;">
                            <label for="remove_profile_photo" style="font-size:12px;color:#f87171;cursor:pointer;font-weight:500;">
                                Hapus foto kustom &amp; reset ke foto bawaan (default)
                            </label>
                        </div>

                        {{-- Optional Custom Path / URL fallback --}}
                        <div style="margin-top:12px;">
                            <label for="profile_photo" style="font-size:10px;color:#71717a;text-transform:uppercase;letter-spacing:0.05em;display:block;margin-bottom:4px;">Atau Path / URL Kustom</label>
                            <input type="text" id="profile_photo" name="profile_photo"
                                   value="{{ old('profile_photo', $settings['profile_photo']) }}"
                                   placeholder="images/profile-photo.png"
                                   class="admin-input"
                                   style="{{ $inputStyle }};font-size:11px;">
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div style="display:flex;align-items:center;gap:10px;padding-top:10px;border-top:1px solid #1f1f22;margin-top:10px;">
                    <button type="submit"
                            style="padding:9px 18px;border-radius:8px;background:#4f46e5;color:#fff;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background 0.15s;"
                            onmouseover="this.style.background='#4338ca';"
                            onmouseout="this.style.background='#4f46e5';">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>

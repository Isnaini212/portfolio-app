<x-admin-layout title="Site Settings">

    <div style="max-width:640px;">

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
            <div>
                <h2 style="font-size:16px;font-weight:600;color:#f4f4f5;margin:0 0 2px;">Hero &amp; Site Settings</h2>
                <p style="font-size:12px;color:#52525b;margin:0;">Customize text and headlines displayed on the home page hero section.</p>
            </div>
        </div>

        <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;padding:24px;">
            <form action="{{ route('admin.settings.update') }}" method="POST">
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
                           placeholder="hello@example.com"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('hero_email') ? 'border-color:#f87171;' : '' }}"
                           required>
                    @error('hero_email') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
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

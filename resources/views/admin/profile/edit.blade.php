<x-admin-layout title="Admin Profile">

    <div style="max-width:640px;">

        <div style="display:flex;align-items:center;justify-space-between;margin-bottom:24px;">
            <div>
                <h2 style="font-size:16px;font-weight:600;color:#f4f4f5;margin:0 0 2px;">Kredensial Akun Admin</h2>
                <p style="font-size:12px;color:#52525b;margin:0;">Kelola email login dan password keamanan untuk akses Dashboard Admin.</p>
            </div>
        </div>

        @if(session('success'))
            <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);color:#4ade80;padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background:#111113;border:1px solid #1f1f22;border-radius:10px;padding:24px;">
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                @php
                    $inputStyle = 'width:100%;background:#18181b;border:1px solid #3f3f46;border-radius:8px;padding:9px 14px;font-size:13px;color:#f4f4f5;outline:none;font-family:inherit;box-sizing:border-box;transition:border-color 0.15s;';
                    $labelStyle = 'display:block;font-size:11px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#52525b;margin-bottom:6px;';
                    $errorStyle = 'font-size:11px;color:#f87171;margin-top:4px;display:block;';
                    $groupStyle = 'margin-bottom:20px;';
                @endphp

                <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid #1f1f22;">
                    <h3 style="font-size:13px;font-weight:600;color:#818cf8;margin:0 0 4px;text-transform:uppercase;letter-spacing:0.05em;">Informasi Akun</h3>
                    <p style="font-size:11px;color:#71717a;margin:0;">Perbarui email utama untuk masuk ke sistem admin.</p>
                </div>

                {{-- Admin Login Email --}}
                <div style="{{ $groupStyle }}">
                    <label for="email" style="{{ $labelStyle }}">Email Login Admin <span style="color:#f87171;">*</span></label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email', $user->email) }}"
                           placeholder="admin@example.com"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('email') ? 'border-color:#f87171;' : '' }}"
                           required>
                    @error('email') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                <div style="margin:28px 0 16px;padding-top:20px;border-top:1px solid #1f1f22;">
                    <h3 style="font-size:13px;font-weight:600;color:#818cf8;margin:0 0 4px;text-transform:uppercase;letter-spacing:0.05em;">Keamanan / Ubah Password</h3>
                    <p style="font-size:11px;color:#71717a;margin:0;">Kosongkan bidang password di bawah ini jika tidak ingin mengubah password.</p>
                </div>

                {{-- Current Password --}}
                <div style="{{ $groupStyle }}">
                    <label for="current_password" style="{{ $labelStyle }}">Password Saat Ini (Diperlukan jika mengubah password)</label>
                    <input type="password" id="current_password" name="current_password"
                           placeholder="••••••••"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('current_password') ? 'border-color:#f87171;' : '' }}">
                    @error('current_password') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- New Password --}}
                <div style="{{ $groupStyle }}">
                    <label for="new_password" style="{{ $labelStyle }}">Password Baru</label>
                    <input type="password" id="new_password" name="new_password"
                           placeholder="Minimal 8 karakter"
                           class="admin-input"
                           style="{{ $inputStyle }} {{ $errors->has('new_password') ? 'border-color:#f87171;' : '' }}">
                    @error('new_password') <span style="{{ $errorStyle }}">{{ $message }}</span> @enderror
                </div>

                {{-- New Password Confirmation --}}
                <div style="{{ $groupStyle }}">
                    <label for="new_password_confirmation" style="{{ $labelStyle }}">Konfirmasi Password Baru</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                           placeholder="Ulangi password baru"
                           class="admin-input"
                           style="{{ $inputStyle }}">
                </div>

                {{-- Submit --}}
                <div style="display:flex;align-items:center;gap:10px;padding-top:16px;border-top:1px solid #1f1f22;margin-top:10px;">
                    <button type="submit"
                            style="padding:9px 18px;border-radius:8px;background:#4f46e5;color:#fff;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background 0.15s;"
                            onmouseover="this.style.background='#4338ca';"
                            onmouseout="this.style.background='#4f46e5';">
                        Simpan Perubahan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>

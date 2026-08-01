<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the site settings form.
     */
    public function index(): View
    {
        $settings = [
            'preloader_text'    => Setting::get('preloader_text', 'INFORMATION SYSTEMS & WEB DEV'),
            'hero_status_badge' => Setting::get('hero_status_badge', 'IS Student & Web Developer'),
            'hero_sub_badge'    => Setting::get('hero_sub_badge', 'Building & learning in public'),
            'hero_headline_1'   => Setting::get('hero_headline_1', 'INFORMATION'),
            'hero_headline_2'   => Setting::get('hero_headline_2', 'SYSTEMS'),
            'hero_headline_3'   => Setting::get('hero_headline_3', '& DEVLOG'),
            'hero_bio'          => Setting::get('hero_bio', 'Mahasiswa Sistem Informasi yang berfokus pada pengembangan aplikasi web modern (Laravel, Livewire, Tailwind CSS) dan manajemen basis data. Mendokumentasikan setiap proses belajar di sini.'),
            'hero_email'        => Setting::get('hero_email', 'muhamadisnaini121@gmail.com'),
            'profile_name'      => Setting::get('profile_name', 'MUHAMAD ISNAINI SAPUTRA'),
            'profile_role'      => Setting::get('profile_role', 'MAHASISWA SISTEM INFORMASI'),
            'profile_phone'     => Setting::get('profile_phone', '081282250402'),
            'profile_location'  => Setting::get('profile_location', 'Tangerang, Banten'),
            'profile_email'     => Setting::get('profile_email', 'muhamadisnaini121@gmail.com'),
            'profile_github'    => Setting::get('profile_github', 'github.com/Isnaini212'),
            'profile_website'   => Setting::get('profile_website', 'www.saputra.site.je'),
            'profile_photo'     => Setting::get('profile_photo', 'images/profile-photo.png'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the site settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        $validated = $request->validate([
            'preloader_text'     => ['required', 'string', 'max:150'],
            'hero_status_badge'  => ['required', 'string', 'max:100'],
            'hero_sub_badge'     => ['required', 'string', 'max:150'],
            'hero_headline_1'    => ['required', 'string', 'max:100'],
            'hero_headline_2'    => ['required', 'string', 'max:100'],
            'hero_headline_3'    => ['required', 'string', 'max:100'],
            'hero_bio'           => ['required', 'string', 'max:500'],
            'hero_email'         => ['required', 'email', 'max:150'],
            'profile_name'       => ['nullable', 'string', 'max:150'],
            'profile_role'       => ['nullable', 'string', 'max:150'],
            'profile_phone'      => ['nullable', 'string', 'max:50'],
            'profile_location'   => ['nullable', 'string', 'max:150'],
            'profile_email'      => ['nullable', 'email', 'max:150'],
            'profile_github'     => ['nullable', 'string', 'max:150'],
            'profile_website'    => ['nullable', 'string', 'max:150'],
            'profile_photo'      => ['nullable', 'string', 'max:255'],
            'profile_photo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'admin_email'        => ['nullable', 'email', 'max:255', 'unique:users,email,' . ($user ? $user->id : '')],
            'current_password'   => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password'       => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        // Update Admin Account Email
        if ($user && $request->filled('admin_email') && $request->admin_email !== $user->email) {
            $user->email = $request->admin_email;
            $user->save();
        }

        // Update Admin Account Password
        if ($user && $request->filled('new_password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
            $user->save();
        }

        unset(
            $validated['admin_email'],
            $validated['current_password'],
            $validated['new_password'],
            $validated['new_password_confirmation']
        );

        // Handle profile photo CRUD operations
        $currentPhoto = Setting::get('profile_photo', 'images/profile-photo.png');

        if ($request->boolean('remove_profile_photo')) {
            // Remove custom uploaded photo from disk
            if ($currentPhoto && str_starts_with($currentPhoto, 'uploads/')) {
                $oldFile = public_path($currentPhoto);
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            } elseif ($currentPhoto && !str_starts_with($currentPhoto, 'images/')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($currentPhoto);
            }
            Setting::set('profile_photo', 'images/profile-photo.png');
            unset($validated['profile_photo']);
        } elseif ($request->hasFile('profile_photo_file')) {
            // Delete old uploaded image if exists
            if ($currentPhoto && str_starts_with($currentPhoto, 'uploads/')) {
                $oldFile = public_path($currentPhoto);
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            } elseif ($currentPhoto && !str_starts_with($currentPhoto, 'images/')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($currentPhoto);
            }

            $file = $request->file('profile_photo_file');
            $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $file->getClientOriginalExtension();
            $uploadDir = public_path('uploads/profile');

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $file->move($uploadDir, $filename);
            $path = 'uploads/profile/' . $filename;

            Setting::set('profile_photo', $path);
            unset($validated['profile_photo']);
        } else {
            // If no new file uploaded and remove not checked
            if (isset($validated['profile_photo'])) {
                if (empty($validated['profile_photo'])) {
                    unset($validated['profile_photo']);
                }
            }
        }

        unset($validated['profile_photo_file'], $validated['remove_profile_photo']);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan situs & akun admin berhasil diperbarui.');
    }
}

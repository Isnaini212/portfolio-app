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
            'hero_email'        => Setting::get('hero_email', 'isnaini@gmail.com'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the site settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'preloader_text'    => ['required', 'string', 'max:150'],
            'hero_status_badge' => ['required', 'string', 'max:100'],
            'hero_sub_badge'    => ['required', 'string', 'max:150'],
            'hero_headline_1'   => ['required', 'string', 'max:100'],
            'hero_headline_2'   => ['required', 'string', 'max:100'],
            'hero_headline_3'   => ['required', 'string', 'max:100'],
            'hero_bio'          => ['required', 'string', 'max:500'],
            'hero_email'        => ['required', 'email', 'max:150'],
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Hero & site settings updated successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LearningLog;
use App\Models\Project;
use Illuminate\View\View;

use App\Models\Setting;

class HomeController extends Controller
{
    /**
     * Display the home page with featured projects, categories, and recent logs.
     */
    public function index(): View
    {
        $featuredProjects = Project::with('category')
            ->where('is_featured', true)
            ->latest()
            ->get();

        $categories = Category::withCount(['projects', 'learningLogs'])->get();

        $recentLogs = LearningLog::with('category')
            ->latest('learned_at')
            ->latest()
            ->get();

        $settings = Setting::getMany([
            'preloader_text'    => 'WELCOME TO MY PORTFOLIO',
            'hero_status_badge' => 'Open to work',
            'hero_sub_badge'    => 'Building & learning in public',
            'hero_headline_1'   => 'Full-Stack',
            'hero_headline_2'   => 'Developer',
            'hero_headline_3'   => '& DevLog',
            'hero_bio'          => 'Building performant web applications using Laravel, Tailwind CSS, and Alpine.js. Documenting every step of the journey here.',
            'hero_email'        => 'muhamadisnaini121@gmail.com',
            'profile_name'      => 'MUHAMAD ISNAINI SAPUTRA',
            'profile_role'      => 'MAHASISWA SISTEM INFORMASI',
            'profile_phone'     => '081282250402',
            'profile_location'  => 'Tangerang, Banten',
            'profile_email'     => 'muhamadisnaini121@gmail.com',
            'profile_github'    => 'github.com/Isnaini212',
            'profile_linkedin'  => 'linkedin.com/in/muhamad-isnaini',
            'profile_website'   => 'www.saputra.site.je',
            'profile_photo'     => 'images/profile-photo.png',
        ]);

        return view('home', compact('featuredProjects', 'categories', 'recentLogs', 'settings'));
    }
}

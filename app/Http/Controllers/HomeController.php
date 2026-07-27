<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LearningLog;
use App\Models\Project;
use Illuminate\View\View;

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
            ->take(5)
            ->get();

        return view('home', compact('featuredProjects', 'categories', 'recentLogs'));
    }
}

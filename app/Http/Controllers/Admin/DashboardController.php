<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LearningLog;
use App\Models\Project;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard overview.
     */
    public function index(): View
    {
        $stats = [
            'total_projects'  => Project::count(),
            'total_logs'      => LearningLog::count(),
            'total_categories'=> Category::count(),
            'featured_projects'=> Project::where('is_featured', true)->count(),
        ];

        $recentProjects = Project::with('category')->latest()->take(5)->get();
        $recentLogs     = LearningLog::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentLogs'));
    }
}

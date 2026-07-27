<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LearningLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearningLogController extends Controller
{
    /**
     * Display a listing of learning logs with optional filtering.
     */
    public function index(Request $request): View
    {
        $query = LearningLog::with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request): void {
                $q->where('slug', $request->input('category'));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $logs = $query->latest('learned_at')->latest()->paginate(10)->withQueryString();
        $categories = Category::all();
        $statuses = ['planning', 'in_progress', 'completed'];

        return view('logs.index', compact('logs', 'categories', 'statuses'));
    }
}

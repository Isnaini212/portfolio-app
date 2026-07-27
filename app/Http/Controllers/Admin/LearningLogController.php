<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LearningLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LearningLogController extends Controller
{
    /**
     * Display a listing of learning logs.
     */
    public function index(): View
    {
        $logs = LearningLog::with('category')->latest('learned_at')->latest()->paginate(15);

        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new learning log.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $statuses   = ['planning', 'in_progress', 'completed'];

        return view('admin.logs.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created learning log in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'unique:learning_logs,slug'],
            'content'     => ['required', 'string'],
            'status'      => ['required', Rule::in(['planning', 'in_progress', 'completed'])],
            'learned_at'  => ['required', 'date'],
        ]);

        LearningLog::create($validated);

        return redirect()->route('admin.logs.index')
            ->with('success', 'Learning log created successfully.');
    }

    /**
     * Show the form for editing the specified learning log.
     */
    public function edit(LearningLog $log): View
    {
        $categories = Category::orderBy('name')->get();
        $statuses   = ['planning', 'in_progress', 'completed'];

        return view('admin.logs.edit', compact('log', 'categories', 'statuses'));
    }

    /**
     * Update the specified learning log in storage.
     */
    public function update(Request $request, LearningLog $log): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'unique:learning_logs,slug,' . $log->id],
            'content'     => ['required', 'string'],
            'status'      => ['required', Rule::in(['planning', 'in_progress', 'completed'])],
            'learned_at'  => ['required', 'date'],
        ]);

        $log->update($validated);

        return redirect()->route('admin.logs.index')
            ->with('success', 'Learning log updated successfully.');
    }

    /**
     * Remove the specified learning log from storage.
     */
    public function destroy(LearningLog $log): RedirectResponse
    {
        $log->delete();

        return redirect()->route('admin.logs.index')
            ->with('success', 'Learning log deleted successfully.');
    }
}

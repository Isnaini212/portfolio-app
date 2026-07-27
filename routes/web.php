<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LearningLogController as AdminLearningLogController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearningLogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SettingController as AdminSettingController;

// ── Public routes ─────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/logs', [LearningLogController::class, 'index'])->name('logs.index');

// ── Auth-protected routes ──────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function (): void {

    // Redirect old /dashboard URL to admin panel
    Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Admin panel ────────────────────────────────────────────────────────────
    Route::prefix('admin')->name('admin.')->group(function (): void {

        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Site Settings
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // Categories CRUD
        Route::post('categories/quick-add', [AdminCategoryController::class, 'quickAdd'])->name('categories.quickAdd');
        Route::resource('categories', AdminCategoryController::class);

        // Projects CRUD
        Route::resource('projects', AdminProjectController::class);

        // Learning Logs CRUD
        Route::resource('logs', AdminLearningLogController::class);
    });
});

require __DIR__.'/auth.php';

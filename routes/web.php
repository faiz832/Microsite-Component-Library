<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ComponentPreviewController;

// Guest Routes
Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::get('/docs/{version?}/{category?}/{component?}', [DocsController::class, 'show'])->name('docs.show');
Route::get('/get-categories/{versionId}', [ComponentController::class, 'getCategories']);
Route::get('/preview/{component}', [ComponentPreviewController::class, 'show'])->name('preview.show');

// Auth Routes
Route::middleware(['auth', 'active'])->group(function () {
    // Dashboard
    Route::get('/home/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Component
    Route::resource('/data/component', ComponentController::class);

    // Category
    Route::resource('/data/category', CategoryController::class);

    // Version
    Route::resource('/data/version', VersionController::class);

    // Profile
    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Setting
    Route::get('/account/settings', [ProfileController::class, 'settings'])->name('settings.edit');
});

// Admin Only
Route::middleware(['auth', 'active', 'role:admin'])->group(function () {
    Route::get('/home/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::patch('/home/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.update.role');
    Route::patch('/home/users/{user}/activation', [UserManagementController::class, 'toggleActivation'])->name('admin.users.toggle.activation');
});

require __DIR__ . '/auth.php';

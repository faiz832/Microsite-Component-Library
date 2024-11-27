<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/docs', function () {
    return view('docs');
})->name('docs');

Route::get('/home/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'active'])->name('dashboard');

Route::middleware(['auth', 'active'])->group(function () {
    // Dashboard

    // Component

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

Route::middleware(['auth', 'active', 'role:admin'])->group(function () {
    Route::get('/home/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::patch('/home/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.update.role');
    Route::patch('/home/users/{user}/activation', [UserManagementController::class, 'toggleActivation'])->name('admin.users.toggle.activation');
});

require __DIR__.'/auth.php';

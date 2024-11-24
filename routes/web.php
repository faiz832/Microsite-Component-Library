<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/docs', function () {
    return view('docs');
})->name('docs');

Route::get('/learn', function () {
    return view('learn');
})->name('learn');

Route::get('/community', function () {
    return view('community');
})->name('community');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'active'])->name('dashboard');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings.edit');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.update.role');
    Route::patch('/admin/users/{user}/activation', [UserManagementController::class, 'toggleActivation'])->name('admin.users.toggle.activation');
});

require __DIR__.'/auth.php';

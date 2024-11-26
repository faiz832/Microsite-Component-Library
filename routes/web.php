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

Route::get('/home/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'active'])->name('dashboard');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/account/settings', [ProfileController::class, 'settings'])->name('settings.edit');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::patch('/home/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.update.role');
    Route::patch('/home/users/{user}/activation', [UserManagementController::class, 'toggleActivation'])->name('admin.users.toggle.activation');
});

require __DIR__.'/auth.php';

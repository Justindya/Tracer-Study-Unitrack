<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\TracerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\UserLokerController;
use App\Http\Controllers\UserAlumniController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AdminAuthController; 

Route::get('/', function () {
    return view('welcome');
});

// Group Admin Login
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Group Admin Dashboard & Features
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Admin Alumni & Export
    Route::resource('alumni', AlumniController::class, ['as' => 'admin']);
    Route::get('alumni/export/all', [AlumniController::class, 'exportAll'])->name('admin.alumni.export.all');
    Route::get('alumni/export/{id}', [AlumniController::class, 'exportSingle'])->name('admin.alumni.export.single');
    
    // Route Verifikasi
    Route::post('alumni/{id}/verify', [AlumniController::class, 'verify'])->name('admin.alumni.verify');

    // CRUD Lainnya
    Route::resource('event', EventController::class, ['as' => 'admin']);
    Route::resource('loker', LokerController::class, ['as' => 'admin']);
    
    // Tracer Study
    Route::resource('tracer', TracerController::class, ['as' => 'admin']);
    Route::get('tracer/export/all', [TracerController::class, 'exportAll'])->name('admin.tracer.export.all');
});

// Group User Features
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', [DashboardController::class, 'userIndex'])->name('dashboard');

    Route::prefix('user')->group(function () {
        Route::resource('alumni', UserAlumniController::class, ['as' => 'user'])->only(['index', 'show', 'edit', 'update']);
        
        Route::resource('events', UserEventController::class, ['as' => 'user'])->only(['index', 'show', 'store']);
        
        Route::resource('lokers', UserLokerController::class, ['as' => 'user'])->only(['index', 'show', 'store']);
    
        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        Route::resource('tracer', \App\Http\Controllers\User\TracerUserController::class, ['as' => 'user']);
    });

    // Frontend Routes
    Route::get('/lamaran', [UserLokerController::class, 'historyLamaran'])->name('user.lamaran.index');
    Route::get('/bookmark', [UserLokerController::class, 'bookmarks'])->name('user.bookmark.index');
    Route::get('/rekomendasi', [UserLokerController::class, 'rekomendasi'])->name('user.rekomendasi');
});

require __DIR__ . '/auth.php';
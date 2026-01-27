<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\TracerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KusionerController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\UserLokerController;
use App\Http\Controllers\UserAlumniController;
use App\Http\Controllers\UserKusionerController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// --- GROUP 1: ROUTE KHUSUS ADMIN ---
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Admin
    Route::resource('alumni', AlumniController::class, ['as' => 'admin']);
    Route::get('alumni/export/all', [AlumniController::class, 'exportAll'])->name('admin.alumni.export.all');
    Route::get('alumni/export/{id}', [AlumniController::class, 'exportSingle'])->name('admin.alumni.export.single');
    Route::resource('event', EventController::class, ['as' => 'admin']);
    Route::resource('loker', LokerController::class, ['as' => 'admin']);
    Route::resource('kusioner', KusionerController::class, ['as' => 'admin']);
    Route::resource('tracer', TracerController::class, ['as' => 'admin']);
    Route::get('tracer/export/all', [TracerController::class, 'exportAll'])->name('admin.tracer.export.all');
});

// --- GROUP 2: ROUTE KHUSUS USER/MAHASISWA ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', [DashboardController::class, 'userIndex'])->name('dashboard');

    Route::prefix('user')->group(function () {
        Route::resource('alumni', UserAlumniController::class, ['as' => 'user'])->only(['index', 'show', 'edit', 'update']);
        Route::resource('events', UserEventController::class, ['as' => 'user'])->only(['index', 'show']);
        Route::resource('lokers', UserLokerController::class, ['as' => 'user'])->only(['index', 'show', 'store']);
        Route::resource('kusioner', UserKusionerController::class, ['as' => 'user'])->only(['index', 'store', 'create']);
    
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
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
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('alumni', AlumniController::class, ['as' => 'admin']);
    Route::resource('mahasiswa', \App\Http\Controllers\MahasiswaController::class, ['as' => 'admin']);
    Route::get('alumni/export/all', [AlumniController::class, 'exportAll'])->name('admin.alumni.export.all');
    Route::get('alumni/export/{id}', [AlumniController::class, 'exportSingle'])->name('admin.alumni.export.single');
    
    Route::post('alumni/{id}/verify', [AlumniController::class, 'verify'])->name('admin.alumni.verify');

    Route::resource('event', EventController::class, ['as' => 'admin']);
    Route::post('event/{id}/approve', [EventController::class, 'approve'])->name('admin.event.approve');
    Route::post('event/{id}/reject', [EventController::class, 'reject'])->name('admin.event.reject');

    Route::resource('loker', LokerController::class, ['as' => 'admin']);
    Route::post('loker/{id}/approve', [LokerController::class, 'approve'])->name('admin.loker.approve');
    Route::post('loker/{id}/reject', [LokerController::class, 'reject'])->name('admin.loker.reject');
    
    Route::resource('tracer', TracerController::class, ['as' => 'admin']);
    Route::get('tracer/export/all', [TracerController::class, 'exportAll'])->name('admin.tracer.export.all');
});

// Group User Features
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'userIndex'])->name('dashboard');

    Route::prefix('user')->group(function () {
        Route::resource('alumni', UserAlumniController::class, ['as' => 'user'])->only(['index', 'show', 'edit', 'update']);
        
        Route::get('events/propose', [UserEventController::class, 'propose'])->name('user.events.propose');
        Route::post('events/propose', [UserEventController::class, 'storePropose'])->name('user.events.propose.store');
        Route::resource('events', UserEventController::class, ['as' => 'user'])->only(['index', 'show', 'store', 'destroy']);
        
        Route::get('lokers/propose', [UserLokerController::class, 'propose'])->name('user.lokers.propose');
        Route::post('lokers/propose', [UserLokerController::class, 'storePropose'])->name('user.lokers.propose.store');
        Route::resource('lokers', UserLokerController::class, ['as' => 'user'])->only(['index', 'show', 'store']);
    
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        //Route untuk cetak CV 
        Route::get('tracer/cv/download', [\App\Http\Controllers\User\TracerUserController::class, 'generateCV'])->name('user.tracer.cv');
        
        Route::resource('tracer', \App\Http\Controllers\User\TracerUserController::class, ['as' => 'user']);
    });

    Route::get('/lamaran', [UserLokerController::class, 'historyLamaran'])->name('user.lamaran.index');
    Route::get('/bookmark', [UserLokerController::class, 'bookmarks'])->name('user.bookmark.index');
    Route::get('/rekomendasi', [UserLokerController::class, 'rekomendasi'])->name('user.rekomendasi');
});

require __DIR__ . '/auth.php';
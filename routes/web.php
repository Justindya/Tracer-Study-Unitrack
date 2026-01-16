<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('admin.dashboard');


Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Admin-specific routes
        Route::resource('alumni', AlumniController::class, ['as' => 'admin']);
        Route::get('alumni/export/all', [AlumniController::class, 'exportAll'])->name('admin.alumni.export.all');
        Route::get('alumni/export/{id}', [AlumniController::class, 'exportSingle'])->name('admin.alumni.export.single');
        Route::resource('event', EventController::class, ['as' => 'admin']);
        Route::resource('loker', LokerController::class, ['as' => 'admin']);
        Route::resource('kusioner', KusionerController::class, ['as' => 'admin']);
        Route::resource('tracer', TracerController::class, ['as' => 'admin']);
        Route::get('tracer/export/all', [TracerController::class, 'exportAll'])->name('admin.tracer.export.all');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->group(function () {
        // User-specific routes
        Route::resource('alumni', UserAlumniController::class, ['as' => 'user'])->only(['index', 'show', 'edit', 'update']);        // Alias for compatibility with old code
        Route::resource('events', UserEventController::class, ['as' => 'user'])->only(['index', 'show']);
        Route::resource('lokers', UserLokerController::class, ['as' => 'user'])->only(['index', 'show']);
        Route::resource('kusioner', UserKusionerController::class, ['as' => 'user'])
            ->only(['index', 'store', 'create']);

        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::resource('tracer', \App\Http\Controllers\User\TracerUserController::class, ['as' => 'user']);
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/destroy', [ProfileController::class, 'delete'])->name('profile.destroy');
    });
});

    // Route untuk Lamaran Saya & Bookmark (Tampilan Saja)
    Route::get('/lamaran', function () {
        return view('user.lamaran_index');
    })->name('user.lamaran.index');

    Route::get('/bookmark', function () {
        return view('user.bookmark_index');
    })->name('user.bookmark.index');

    

require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TutorDetailController;
use App\Http\Controllers\PresentationController;

Route::get('/', function () {
    return view('auth.login');
});

// Protected routes for authenticated users
Route::middleware(['api.auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes for tutorials
    Route::resource('tutorials', TutorialController::class);

    // Nested routes for tutorial details
    Route::get('/tutorials/{tutorial}/details', [TutorDetailController::class, 'index'])->name('tutorial.details.index');
    Route::post('/tutorials/{tutorial}/details', [TutorDetailController::class, 'store'])->name('tutorial.details.store');
    Route::delete('/tutorial-details/{detail}', [TutorDetailController::class, 'destroy'])->name('tutorial.details.destroy');
    Route::patch('/tutorial-details/{detail}/toggle', [TutorDetailController::class, 'toggleStatus'])->name('tutorial.details.toggle');
    Route::put('/tutorial-details/{detail}', [TutorDetailController::class, 'update'])->name('tutorial.details.update');
});

// Public routes for presentation
Route::get('/presentation/{url}', [PresentationController::class, 'index'])->name('presentation.index');
Route::get('/finished/{url}', [PresentationController::class, 'downloadPdf'])->name('presentation.finished');
Route::get('/api/{kode_matkul}', [TutorialController::class, 'apiTutorials']);



require __DIR__ . '/auth.php';

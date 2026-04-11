<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TutorDetailController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['api.auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tutorials', TutorialController::class);

    Route::get('/tutorials/{tutorial}/details', [TutorDetailController::class, 'index'])->name('tutor-details.index');
    Route::post('/tutorials/{tutorial}/details', [TutorDetailController::class, 'store'])->name('tutor-details.store');
    Route::delete('/tutorials/{tutorial}/details', [TutorDetailController::class, 'destroy'])->name('tutor-details.destroy');});

require __DIR__ . '/auth.php';

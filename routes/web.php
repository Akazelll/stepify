<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TutorDetailController;
use App\Http\Controllers\PresentationController;

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware(['api.auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('tutorials', TutorialController::class);

    Route::get('/tutorials/{tutorial}/details', [TutorDetailController::class, 'index'])->name('tutorial.details.index');
    Route::post('/tutorials/{tutorial}/details', [TutorDetailController::class, 'store'])->name('tutorial.details.store');
    Route::delete('/tutorials/{tutorial}/details', [TutorDetailController::class, 'destroy'])->name('tutorial.details.destroy');
    Route::patch('/tutorial-details/{detail}/toggle', [TutorDetailController::class, 'toggleStatus'])->name('tutorial.details.toggle');
});

Route::get('/presentation/{url}', [PresentationController::class, 'show'])->name('presentation.show');
Route::get('/finished/{url}', [PresentationController::class, 'downloadPdf'])->name('presentation.finished');
Route::get('/api/{kode_matkul}', [TutorialController::class, 'apiTutorials']);

Route::put('/tutorial-details/{detail}',[TutorDetailController::class, 'update'])->name('tutorial.details.update');


require __DIR__ . '/auth.php';

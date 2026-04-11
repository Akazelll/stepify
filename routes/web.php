<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['api.auth'])->name('dashboard');

Route::get('/test-makul', function () {
    $token = \Illuminate\Support\Facades\Session::get('refreshToken');

    if (!$token) {
        return "Gagal: Token kosong di session.";
    }

    // 1. BERSUNGUT-SUNGUT MODE: Kita bersihkan token dari spasi atau kutip ekstra
    $cleanToken = trim(str_replace('"', '', $token));

    // 2. MANUAL HEADER: Kita tiru persis kelakuan Postman
    $response = \Illuminate\Support\Facades\Http::withHeaders([
        'Authorization' => 'Bearer ' . $cleanToken,
        'Accept'        => 'application/json',
    ])->get('https://jwt-auth-eight-neon.vercel.app/getMakul');

    // 3. Tampilkan hasil interogasi
    return response()->json([
        'panjang_token' => strlen($cleanToken),
        'token_yang_dikirim' => $cleanToken,
        'status_kode' => $response->status(),
        'balasan_api' => $response->json()
    ]);
});
require __DIR__.'/auth.php';

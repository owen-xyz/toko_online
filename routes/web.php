<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

// Rute utama yang mengarahkan ke login
Route::get('/', function () {
    return redirect()->route('backend.login');
});

// Mengelompokkan rute backend
Route::prefix('backend')->as('backend.')->group(function () {
    // Rute untuk login/logout
    Route::get('login', [LoginController::class, 'loginBackend'])
        ->name('login');

    Route::post('login', [LoginController::class, 'authenticateBackend'])
        ->name('login');

    Route::post('logout', [LoginController::class, 'logoutBackend'])
        ->name('logout');

    // Rute yang membutuhkan autentikasi
    Route::middleware('auth')->group(function () {
        Route::get('beranda', [BerandaController::class, 'berandaBackend'])
            ->name('beranda');

        // Rute resource untuk UserController
        Route::resource('user', UserController::class);

        // Rute resource untuk KategoriController
        Route::resource('kategori', KategoriController::class);
    });
});

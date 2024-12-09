<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;

// Redirect root to backend login
Route::get('/', function () {
    return redirect()->route('backend.login');
});

// Backend routes with middleware and grouping
Route::prefix('backend')->name('backend.')->group(function () {

    // Authentication routes
    Route::get('login', [LoginController::class, 'loginBackend'])->name('login');
    Route::post('login', [LoginController::class, 'authenticateBackend'])->name('login');
    Route::post('logout', [LoginController::class, 'logoutBackend'])->name('logout');

    // Protected routes (requires authentication)
    Route::middleware('auth')->group(function () {
        Route::get('beranda', [BerandaController::class, 'berandaBackend'])->name('beranda');
        Route::resource('user', UserController::class);
        Route::resource('kategori', KategoriController::class);
    });
});
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth');
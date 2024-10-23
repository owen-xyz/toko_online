<?php

use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Rute utama yang mengarahkan ke login
Route::get('/', function () {
    return redirect()->route('backend.login');
});

// Mengelompokkan rute backend
Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    Route::get('beranda', [BerandaController::class, 'berandaBackend'])
        ->name('beranda')
        ->middleware('auth');

    Route::get('login', [LoginController::class, 'loginBackend'])
        ->name('login');

    Route::post('login', [LoginController::class, 'authenticateBackend'])
        ->name('login');

    Route::post('logout', [LoginController::class, 'logoutBackend'])
        ->name('logout');
});

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/buku');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.authenticate');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::resource('buku', BukuController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

Route::resource('buku', BukuController::class)
    ->only(['index', 'show']);
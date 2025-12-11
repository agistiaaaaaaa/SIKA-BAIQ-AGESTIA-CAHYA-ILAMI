<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Mahasiswa resource (protected by auth middleware)
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');

// Home page (public)
Route::view('/', 'home');

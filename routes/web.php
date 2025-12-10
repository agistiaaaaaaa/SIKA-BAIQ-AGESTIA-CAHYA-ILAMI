<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Mahasiswa resource (protected by auth middleware)
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');

// Home redirect (auth handled by controller middleware)
Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

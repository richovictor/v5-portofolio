<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;

//route user
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

Route::get('/registrasi', [AuthController::class, 'processRegistrasi'])->name('registration.process');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registration.submit');

Route::get('/siswa', [SiswaController::class, 'tampil'])->name('siswa.tampil');






Route::get('/blog', function () {
    return view('blog');
});

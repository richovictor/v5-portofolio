<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\CoverController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request; 
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;


//route user
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::middleware(['auth', 'verified', 'role:siswa'])->group(function () {
    Route::get('/siswa', [SiswaController::class, 'halamanSiswa'])->name('laman.siswa');
    Route::get('/profil', [SiswaController::class, 'profil'])->name('profil.siswa');
    Route::post('/profil/update', [SiswaController::class, 'updateProfil'])->name('profil.update');
});

// verif dlu baru login
Route::middleware('auth')->group(function (){
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect()->route('verification.success')->with('success', 'Email berhasil diverifikasi.');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::get('/email/verified-success', function () {
    return view('auth.verified-success');
})->name('verification.success');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');


Route::get('/login', [AuthController::class, 'processLogin'])->name('login');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

Route::get('/registrasi', [AuthController::class, 'processRegistrasi'])->name('registration.process');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registration.submit');

Route::delete('/profil/hapus-foto', [SiswaController::class, 'hapusFoto'])->name('profil.hapusFoto');

Route::post('/profil/upload-cover', [CoverController::class, 'uploadCover'])->name('profil.uploadCover');
Route::delete('/profil/hapus-cover', [CoverController::class, 'hapusCover'])->name('profil.hapusCover');

Route::put('/profil/kontak', [SiswaController::class, 'updateKontak'])->name('profil.updateKontak');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/dashboard'); 
})->name('logout');

Route::get('/blog', function () {
    return view('blog');
});
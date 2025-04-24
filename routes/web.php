<?php

use App\Http\Controllers\ActivitiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\CoverController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\SelectedSkillsController;
use App\Http\Controllers\CertificatesController;
use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\SubmiEmailController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CVController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminUserController;

//route user
Route::get('/', [HomeController::class, 'index']);
// Route::get('/', function () {
//     return view('dashboard');
// });
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
Route::post('/submitEmail', [SubmiEmailController::class, 'submit'])->name('email.submit');

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
    return redirect('/');
})->name('logout');

Route::get('/blog', function () {
    return view('blog');
});

// Route::middleware(['', 'verified', 'role:siswa'])->group(function () {
//     Route::get('/siswa', [SiswaController::class, 'halamanSiswa'])->name('laman.siswa');
//     Route::get('/profil', [SiswaController::class, 'profil'])->name('profil.siswa');
//     Route::post('/profil/update', [SiswaController::class, 'updateProfil'])->name('profil.update');
// });
Route::get('/all-student', [HomeController::class, 'seeall'])->name('allstudent.seeall');
Route::get('/view/{id}/', [SiswaController::class, 'view'])->name('profile.view');
Route::group(['middleware' => ['role:siswa|guru|superadmin','verified','auth']], function(){
    Route::get('/cetak-cv', [CVController::class, 'generatePDF'])->name('cv.generate');

    Route::group(['prefix' => 'profile', 'as' => 'profile.','namespace'=> 'profile.'], function () {
        Route::get('/siswa', [SiswaController::class, 'index'])->name('index');

        Route::get('/create', [SiswaController::class, 'create'])->name('create');
        Route::post('/', [SiswaController::class, 'store'])->name('store');
        Route::get('/{id}', [SiswaController::class, 'show'])->name('show');
        Route::get('/edit', [SiswaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SiswaController::class, 'update'])->name('update');
        Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'selectedskills', 'as' => 'selectedskills.','namespace'=> 'selectedskills.'], function () {
        Route::get('/siswa', [SelectedSkillsController::class, 'index'])->name('index');
        Route::get('/view/{id}/', [SelectedSkillsController::class, 'view'])->name('view');
        Route::get('/create', [SelectedSkillsController::class, 'create'])->name('create');
        Route::post('/', [SelectedSkillsController::class, 'store'])->name('store');
        Route::get('/{id}', [SelectedSkillsController::class, 'show'])->name('show');
        Route::get('/edit', [SelectedSkillsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [SelectedSkillsController::class, 'update'])->name('update');
        Route::delete('/{id}', [SelectedSkillsController::class, 'destroy'])->name('destroy');
    });
    Route::group(['prefix' => 'Certificates', 'as' => 'certificates.','namespace'=> 'certificates.'], function () {
        Route::get('/siswa', [CertificatesController::class, 'index'])->name('index');
        Route::get('/view/{id}/', [CertificatesController::class, 'view'])->name('view');
        Route::get('/create', [CertificatesController::class, 'create'])->name('create');
        Route::post('/', [CertificatesController::class, 'store'])->name('store');
        Route::get('/{id}', [CertificatesController::class, 'show'])->name('show');
        Route::get('/edit', [CertificatesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CertificatesController::class, 'update'])->name('update');
        Route::delete('/{id}', [CertificatesController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'experiences', 'as' => 'experiences.','namespace'=> 'experiences.'], function () {
        Route::get('/siswa', [ExperiencesController::class, 'index'])->name('index');
        Route::get('/view/{id}/', [ExperiencesController::class, 'view'])->name('view');
        Route::get('/create', [ExperiencesController::class, 'create'])->name('create');
        Route::post('/', [ExperiencesController::class, 'store'])->name('store');
        Route::get('/{id}', [ExperiencesController::class, 'show'])->name('show');
        Route::get('/edit', [ExperiencesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ExperiencesController::class, 'update'])->name('update');
        Route::delete('/{id}', [ExperiencesController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'activities', 'as' => 'activities.','namespace'=> 'activities.'], function () {
        Route::get('/siswa', [ActivitiesController::class, 'index'])->name('index');
        Route::get('/view/{id}/', [ActivitiesController::class, 'view'])->name('view');
        Route::get('/create', [ActivitiesController::class, 'create'])->name('create');
        Route::post('/', [ActivitiesController::class, 'store'])->name('store');
        Route::get('/{id}', [ActivitiesController::class, 'show'])->name('show');
        Route::get('/edit', [ActivitiesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ActivitiesController::class, 'update'])->name('update');
        Route::delete('/{id}', [ActivitiesController::class, 'destroy'])->name('destroy');
    });
});

Route::group(['prefix'=>'adminIndex', 'as'=>'adminIndex.', 'namespace'=>'adminIndex.'], function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::group(['prefix' => 'user', 'as' => 'user.','namespace'=> 'user.'], function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/view/{id}/', [AdminUserController::class, 'view'])->name('view');
        Route::put('/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
        Route::put('/role/{id}', [AdminUserController::class, 'updateRole'])->name('role');

    });
});




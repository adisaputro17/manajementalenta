<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PredikatKinerjaController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\PenugasanTimController;
use App\Http\Controllers\PendidikanFormalController;
use App\Http\Controllers\PengembanganKompetensiController;
use App\Http\Controllers\RiwayatJabatanController;
use App\Http\Controllers\OrganisasiPegawaiController;
use App\Http\Controllers\HukumanDisiplinController;
use App\Http\Controllers\TalentWeightController;
use App\Http\Controllers\TalentDashboardController;
use App\Http\Controllers\TalentMatrixController;

/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {
        return redirect()->route('talent.dashboard');
    }

    return redirect()->route('login');

});

/*
|--------------------------------------------------------------------------
| Guest
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.post');

});

/*
|--------------------------------------------------------------------------
| Authenticated User
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Dashboard
    Route::get('/talent/dashboard', [TalentDashboardController::class, 'index'])
        ->name('talent.dashboard');

    Route::get('/talent/matrix', [TalentMatrixController::class, 'index'])
        ->name('talent.matrix');

    // Master
    Route::resource('pegawai', PegawaiController::class);

    // Penilaian Kinerja
    Route::resource('predikat', PredikatKinerjaController::class);
    Route::post('predikat/{predikat}/approve',[PredikatKinerjaController::class,'approve'])->name('predikat.approve');
    Route::post('predikat/{predikat}/reject',[PredikatKinerjaController::class,'reject'])->name('predikat.reject');
    
    // Penghargaan
    Route::resource('penghargaan', PenghargaanController::class);
    Route::post('penghargaan/{penghargaan}/approve',[PenghargaanController::class,'approve'])->name('penghargaan.approve');
    Route::post('penghargaan/{penghargaan}/reject',[PenghargaanController::class,'reject'])->name('penghargaan.reject');

    // Penugasan
    Route::resource('penugasan', PenugasanTimController::class);
    Route::post('penugasan/{penugasan}/approve',[PenugasanTimController::class,'approve'])->name('penugasan.approve');
    Route::post('penugasan/{penugasan}/reject',[PenugasanTimController::class,'reject'])->name('penugasan.reject');

    // Penilaian Potensial
    Route::resource('pendidikan', PendidikanFormalController::class);
    Route::resource('kompetensi', PengembanganKompetensiController::class);
    Route::resource('riwayat-jabatan', RiwayatJabatanController::class);
    Route::resource('organisasi', OrganisasiPegawaiController::class);
    Route::resource('hukuman', HukumanDisiplinController::class);

    // Pengaturan
    Route::resource('talent-weight', TalentWeightController::class);

});
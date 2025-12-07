<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ManajemenPekerjaController;
use App\Http\Controllers\PekerjaStatusController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/kategori', [LandingController::class, 'index'])->name('kategori.all');
Route::get('/landing', [LandingController::class, 'index'])->name('landing.list');
Route::get('/jasa/{slug}', [LandingController::class, 'show'])->name('jasa.show');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* MANEJEMEN ANGGOTA */
    Route::resource('anggota', AnggotaController::class)->names([
        'index' => 'dataAnggota',
        'create' => 'createAnggota',
        'store' => 'storeAnggota',
        'edit' => 'editAnggota',
        'update' => 'updateAnggota',
        'destroy' => 'deleteAnggota',
    ]);

    /* MANAJEMEN USER & KATEGORI */
    Route::resource('manajemen-user', ManajemenUserController::class);
    Route::resource('kategori', KategoriController::class);

    /*
    |--------------------------------------------------------------------------
    | ADMIN MANAJEMEN JASA (Pekerja submit → Admin approve/reject)
    |--------------------------------------------------------------------------
    */
    Route::prefix('jasa')->group(function () {

        Route::get('/', [JasaController::class, 'adminIndex'])
            ->name('admin.jasa.index');

        Route::get('/{id}/detail', [JasaController::class, 'adminDetail'])
            ->name('admin.jasa.detail');

        Route::post('/{id}/approve', [JasaController::class, 'approve'])
            ->name('admin.jasa.approve');

        Route::post('/{id}/reject', [JasaController::class, 'reject'])
            ->name('admin.jasa.reject');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN MANAJEMEN PEKERJA
    |--------------------------------------------------------------------------
    */
    Route::get('/pekerja', [ManajemenPekerjaController::class, 'index'])
        ->name('admin.pekerja.index');

    Route::get('/pekerja/{id}', [ManajemenPekerjaController::class, 'show'])
        ->name('admin.pekerja.show');

    Route::post('/pekerja/{id}/update-status', [ManajemenPekerjaController::class, 'updateStatus'])
        ->name('admin.pekerja.update-status');

    Route::delete('/pekerja/{id}', [ManajemenPekerjaController::class, 'destroy'])
        ->name('admin.pekerja.delete');
});

/*
|--------------------------------------------------------------------------
| PEKERJA AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pekerja'])
    ->prefix('pekerja')
    ->group(function () {

    /* DASHBOARD PEKERJA */
    Route::get('/dashboard', fn() => view('pekerja.dashboard'))
        ->name('pekerja.dashboard');

    /*
    |--------------------------------------------------------------------------
    | ROUTE SEBELUM DIVERIFIKASI ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/account/status', [PekerjaStatusController::class, 'index'])
        ->name('pekerja.account.status');

    Route::get('/account/ktp', [PekerjaStatusController::class, 'ktpForm'])
        ->name('pekerja.account.ktp');

    Route::post('/account/ktp', [PekerjaStatusController::class, 'ktpUpload'])
        ->name('pekerja.account.ktp.upload');

    Route::get('/account/profile', [PekerjaStatusController::class, 'profileForm'])
        ->name('pekerja.account.profile');

    Route::post('/account/profile', [PekerjaStatusController::class, 'profileUpdate'])
        ->name('pekerja.account.profile.update');

    Route::get('/account/rekening', [PekerjaStatusController::class, 'rekeningForm'])
        ->name('pekerja.account.rekening');

    Route::post('/account/rekening', [PekerjaStatusController::class, 'rekeningUpdate'])
        ->name('pekerja.account.rekening.update');

    Route::post('/account/submit-verification', [PekerjaStatusController::class, 'submitVerification'])
        ->name('pekerja.account.submit');

    /*
    |--------------------------------------------------------------------------
    | ROUTE UNTUK PEKERJA YANG SUDAH DIVERIFIKASI
    |--------------------------------------------------------------------------
    */
    Route::middleware(['verified.worker'])
        ->prefix('manajemen-jasa')
        ->group(function () {

        Route::get('/', [JasaController::class, 'index'])
            ->name('pekerja.manajemen-jasa.index');

        Route::get('/create', [JasaController::class, 'create'])
            ->name('pekerja.manajemen-jasa.create');

        Route::post('/store', [JasaController::class, 'store'])
            ->name('pekerja.manajemen-jasa.store');

        Route::get('/edit/{id}', [JasaController::class, 'edit'])
            ->name('pekerja.manajemen-jasa.edit');

        Route::put('/update/{id}', [JasaController::class, 'update'])
            ->name('pekerja.manajemen-jasa.update');

        Route::delete('/delete/{id}', [JasaController::class, 'destroy'])
            ->name('pekerja.manajemen-jasa.delete');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\LandingJasaController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ManajemenPekerjaController;

use App\Models\Jasa;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingJasaController::class, 'index'])->name('landing');
Route::get('/landing', [LandingJasaController::class, 'index'])->name('landing.list');
Route::get('/jasa/{slug}', [LandingJasaController::class, 'show'])->name('jasa.show');

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
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/data-anggota', [AnggotaController::class, 'index'])->name('dataAnggota');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('createAnggota');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('storeAnggota');
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('editAnggota');
    Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('updateAnggota');
    Route::delete('/anggota/delete/{id}', [AnggotaController::class, 'destroy'])->name('deleteAnggota');


    Route::prefix('admin/jasa')->group(function () {
        Route::get('/', [JasaController::class, 'adminIndex'])->name('jasa.index');
        Route::get('/create', [JasaController::class, 'create'])->name('jasa.create');
        Route::post('/', [JasaController::class, 'store'])->name('jasa.store');
        Route::get('/{id}/edit', [JasaController::class, 'edit'])->name('jasa.edit');
        Route::put('/{id}', [JasaController::class, 'update'])->name('jasa.update');
        Route::delete('/{id}', [JasaController::class, 'destroy'])->name('jasa.destroy');
    });

    Route::resource('/manajemen-user', ManajemenUserController::class);

    Route::resource('kategori', KategoriController::class);

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/pekerja', [ManajemenPekerjaController::class, 'index'])->name('pekerja.index');
    Route::get('/pekerja/{id}', [ManajemenPekerjaController::class, 'show'])->name('pekerja.show');
    Route::put('/pekerja/{id}/status', [ManajemenPekerjaController::class, 'updateStatus'])->name('pekerja.updateStatus');
    Route::delete('/pekerja/{id}', [ManajemenPekerjaController::class, 'destroy'])->name('pekerja.delete');

});


});

/*
|--------------------------------------------------------------------------
| PEKERJA ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pekerja'])->group(function () {

    Route::get('/pekerja/dashboard', function () {
        return view('pekerja.dashboard');
    })->name('pekerja.dashboard');

    Route::prefix('pekerja/manajemen-jasa')->group(function () {
        Route::get('/', [JasaController::class, 'index'])->name('pekerja.manajemen-jasa.index');
        Route::get('/create', [JasaController::class, 'create'])->name('pekerja.manajemen-jasa.create');
        Route::post('/store', [JasaController::class, 'store'])->name('pekerja.manajemen-jasa.store');
        Route::get('/edit/{id}', [JasaController::class, 'edit'])->name('pekerja.manajemen-jasa.edit');
        Route::put('/update/{id}', [JasaController::class, 'update'])->name('pekerja.manajemen-jasa.update');
        Route::delete('/delete/{id}', [JasaController::class, 'destroy'])->name('pekerja.manajemen-jasa.delete');
    });
});

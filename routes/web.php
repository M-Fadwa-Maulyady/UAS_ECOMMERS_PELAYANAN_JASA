<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JasaController;
use App\Models\Jasa;

// Halaman utama (menampilkan data jasa di welcome)
Route::get('/', function () {
    $jasas = Jasa::all();
    return view('welcome', compact('jasas'));
});

// Halaman landing publik
Route::get('/landing', [JasaController::class, 'index'])->name('landing');

// Autentikasi pengguna
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Admin area (hanya untuk user dengan role admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    // CRUD Data Anggota
    Route::get('/data-anggota', [AnggotaController::class, 'index'])->name('dataAnggota');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('createAnggota');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('storeAnggota');
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('editAnggota');
    Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('updateAnggota');
    Route::delete('/anggota/delete/{id}', [AnggotaController::class, 'destroy'])->name('deleteAnggota');

    // Data Kategori
    Route::get('/data-kategori', [KategoriController::class, 'index'])->name('dataKategori');

    // CRUD Data Jasa di panel admin
    Route::prefix('admin/jasa')->group(function () {
        Route::get('/', [JasaController::class, 'adminIndex'])->name('jasa.index');
        Route::get('/create', [JasaController::class, 'create'])->name('jasa.create');
        Route::post('/', [JasaController::class, 'store'])->name('jasa.store');
        Route::get('/{id}/edit', [JasaController::class, 'edit'])->name('jasa.edit');
        Route::put('/{id}', [JasaController::class, 'update'])->name('jasa.update');
        Route::delete('/{id}', [JasaController::class, 'destroy'])->name('jasa.destroy');
    });
});

// Halaman detail jasa (publik)
Route::get('/jasa/{slug}', [JasaController::class, 'show'])->name('jasa.show');

// Dashboard umum (akses setelah login)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

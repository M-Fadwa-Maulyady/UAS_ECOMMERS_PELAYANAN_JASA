<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KategoriController;

// halaman landing (khusus user)
Route::get('/landing', function () {
    return view('landing', ['user' => Auth::user()]);
})->middleware('auth')->name('landing');

// halaman default
Route::get('/', function () {
    return view('welcome');
});


// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


// middleware admin
Route::middleware(['auth', 'role:admin'])->group(function () {
// Data Anggota Routes dengan CRUD
    Route::get('/data-anggota', [AnggotaController::class, 'index'])->name('dataAnggota');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('createAnggota');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('storeAnggota');
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('editAnggota');
    Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('updateAnggota');
    Route::delete('/anggota/delete/{id}', [AnggotaController::class, 'destroy'])->name('deleteAnggota');
});

// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth'])
//     ->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/data-kategori', [KategoriController::class, 'index'])->name('dataKategori');


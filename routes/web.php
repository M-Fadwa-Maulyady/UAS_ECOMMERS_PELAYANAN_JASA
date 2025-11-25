<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\JasaController;

/*
|--------------------------------------------------------------------------
| Halaman Guest
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Halaman User (Landing Page)
|--------------------------------------------------------------------------
*/
Route::get('/landing', function () {
    return view('landing', ['user' => Auth::user()]);
})
->middleware(['auth', 'role:user'])
->name('landing');


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD Anggota
    Route::get('/data-anggota', [AnggotaController::class, 'index'])->name('dataAnggota');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('createAnggota');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('storeAnggota');
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('editAnggota');
    Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('updateAnggota');
    Route::delete('/anggota/delete/{id}', [AnggotaController::class, 'destroy'])->name('deleteAnggota');

});

Route::middleware(['auth', 'role:pekerja'])->group(function () {

    Route::get('/pekerja/dashboard', function () {
        return view('pekerja.dashboard');
    })->name('pekerja.dashboard');

    // Manajemen Jasa by Pekerja
    Route::get('/pekerja/manajemen-jasa', [JasaController::class, 'index'])
        ->name('pekerja.manajemen-jasa.index');

    Route::get('/pekerja/manajemen-jasa/create', [JasaController::class, 'create'])
        ->name('pekerja.manajemen-jasa.create');

    Route::post('/pekerja/manajemen-jasa/store', [JasaController::class, 'store'])
        ->name('pekerja.manajemen-jasa.store');

    Route::get('/pekerja/manajemen-jasa/edit/{id}', [JasaController::class, 'edit'])
        ->name('pekerja.manajemen-jasa.edit');

    Route::put('/pekerja/manajemen-jasa/update/{id}', [JasaController::class, 'update'])
        ->name('pekerja.manajemen-jasa.update');

    Route::delete('/pekerja/manajemen-jasa/delete/{id}', [JasaController::class, 'destroy'])
        ->name('pekerja.manajemen-jasa.delete');
});






/*
|--------------------------------------------------------------------------
| Pekerja Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pekerja'])->group(function () {

    Route::get('/pekerja/dashboard', function () {
        return view('pekerja.dashboard');
    })->name('pekerja.dashboard');

});

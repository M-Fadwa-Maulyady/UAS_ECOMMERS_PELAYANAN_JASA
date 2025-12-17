<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ManajemenUserController;
use App\Http\Controllers\ManajemenPekerjaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PekerjaStatusController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WorkerBalanceController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/jasa/{slug}', [LandingController::class, 'show'])->name('jasa.show');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| DASHBOARD GLOBAL
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'pekerja' => redirect()->route('pekerja.dashboard'),
        'user'    => redirect()->route('user.orders'),
        default   => redirect()->route('landing'),
    };
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/orders', [OrderController::class, 'userOrders'])
            ->name('orders');

        Route::get('/orders/{order}/chat', [OrderController::class, 'chat'])
            ->name('orders.chat');

        Route::post('/orders/{order}/chat/send', [OrderController::class, 'sendChat'])
            ->name('orders.chat.send');
});

/*
|--------------------------------------------------------------------------
| CHECKOUT (USER)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:user'])->group(function () {

    Route::get('/checkout/success', function () {
        return view('user.checkout-success');
    })->name('checkout.success');

    Route::get('/checkout/{slug}', [CheckoutController::class, 'checkoutPage'])
        ->name('checkout.page');

    Route::post('/checkout/{id}', [CheckoutController::class, 'store'])
        ->name('checkout.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN ✅ (SATU-SATUNYA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
            
        // MASTER DATA
        Route::resource('manajemen-user', ManajemenUserController::class);
        Route::resource('kategori', KategoriController::class);

        Route::resource('pekerja', ManajemenPekerjaController::class)
            ->except(['create', 'store']);

        // JASA
        Route::get('/jasa', [JasaController::class, 'adminIndex'])
            ->name('jasa.index');

        Route::get('/jasa/{id}/detail', [JasaController::class, 'adminDetail'])
            ->name('jasa.detail');

        // ORDER (APPROVE / REJECT)
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders');

        Route::post('/orders/{id}/approve', [OrderController::class, 'approve'])
            ->name('orders.approve');

        Route::post('/orders/{id}/reject', [OrderController::class, 'reject'])
            ->name('orders.reject');

       Route::get('/payments', [PaymentController::class, 'index'])
             ->name('payments');

        Route::post('/payments/{payment}/approve', [PaymentController::class, 'approve'])
            ->name('payments.approve');

        Route::post('/payments/{payment}/send-worker', [PaymentController::class, 'sendToWorker'])
            ->name('payments.sendWorker');
        Route::post('/jasa/{id}/approve', [JasaController::class, 'approve'])
            ->name('jasa.approve');

        Route::post('/jasa/{id}/reject', [JasaController::class, 'reject'])
            ->name('jasa.reject');

            


});

/*
|--------------------------------------------------------------------------
| PEKERJA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:pekerja'])
    ->prefix('pekerja')
    ->name('pekerja.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'pekerja'])
            ->name('dashboard');

        Route::resource('manajemen-jasa', JasaController::class);

        Route::get('/orders', [OrderController::class, 'workerOrders'])
            ->name('orders.index');

        Route::post('/orders/{id}/accept', [OrderController::class, 'accept'])
            ->name('orders.accept');

        Route::post('/orders/{id}/reject', [OrderController::class, 'rejectWorker'])
            ->name('orders.reject');

        Route::get('/account/status', [PekerjaStatusController::class, 'index'])
            ->name('account.status');

        Route::get('/chat', [OrderController::class, 'workerChatList'])
            ->name('chat');

        Route::get('/chat/{order}', [OrderController::class, 'workerChat'])
            ->name('chat.show');

        Route::post('/chat/{order}/send', [OrderController::class, 'sendChat'])
            ->name('chat.send');

        Route::get('/ratings', [RatingController::class, 'workerIndex'])
            ->name('ratings');

        // STATUS
        Route::get('/account/status', [PekerjaStatusController::class, 'index'])
            ->name('account.status');

        // KTP
        Route::get('/account/ktp', [PekerjaStatusController::class, 'ktpForm'])
            ->name('account.ktp');

        Route::post('/account/ktp', [PekerjaStatusController::class, 'ktpUpload'])
            ->name('account.ktp.upload');

        // PROFIL
        Route::get('/account/profile', [PekerjaStatusController::class, 'profileForm'])
            ->name('account.profile');

        Route::post('/account/profile', [PekerjaStatusController::class, 'profileUpdate'])
            ->name('account.profile.update');

        // REKENING
        Route::get('/account/rekening', [PekerjaStatusController::class, 'rekeningForm'])
            ->name('account.rekening');

        Route::post('/account/rekening', [PekerjaStatusController::class, 'rekeningUpdate'])
            ->name('account.rekening.update');

        // SUBMIT VERIFIKASI
        Route::post('/account/submit', [PekerjaStatusController::class, 'submitVerification'])
            ->name('account.submit');
});



/*
|--------------------------------------------------------------------------
| WORKER BALANCE
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------|
| PAYMENT (USER)
|--------------------------------------------------------------------------|
*/
Route::middleware(['auth','role:user'])
    ->prefix('payment')
    ->name('payment.')
    ->group(function () {

        Route::get('/{order}', [PaymentController::class, 'create'])
            ->name('create'); // payment.create

        Route::post('/{order}', [PaymentController::class, 'store'])
            ->name('store'); // payment.store

        Route::get('/upload/{payment}', [PaymentController::class, 'uploadForm'])
            ->name('upload.form'); // payment.upload.form

        Route::post('/upload/{payment}', [PaymentController::class, 'upload'])
            ->name('upload'); // payment.upload
});

/*
|--------------------------------------------------------------------------|
| WORKER BALANCE (PEKERJA)
|--------------------------------------------------------------------------|
*/
Route::middleware(['auth','role:pekerja'])
    ->prefix('worker')
    ->name('worker.')
    ->group(function () {

        Route::get('/saldo', [WorkerBalanceController::class, 'index'])
            ->name('saldo'); // 🔥 INI YANG HILANG

        Route::post('/saldo/withdraw', [WorkerBalanceController::class, 'withdraw'])
            ->name('saldo.withdraw');
});




Route::middleware(['auth','role:user'])
    ->prefix('rating')
    ->name('rating.')
    ->group(function () {

        Route::get('/{order}', [RatingController::class, 'create'])
            ->name('create');

        Route::post('/{order}', [RatingController::class, 'store'])
            ->name('store');
});













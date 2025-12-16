<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $jumlahAnggota = User::count(); // contoh hitung semua user
    // $jumlahProduk = Produk::count();
    // $jumlahKategori = Kategori::count();

    return view('admin.dashboard', compact('jumlahAnggota'));
}

public function pekerja()
{
    $user = auth()->user();

    $orderBaru = \App\Models\Order::where('worker_id', $user->id)
        ->where('status', 'waiting_worker')
        ->count();

    $orderAktif = \App\Models\Order::where('worker_id', $user->id)
        ->whereIn('status', ['accepted_worker', 'on_progress'])
        ->count();

    $orderSelesai = \App\Models\Order::where('worker_id', $user->id)
        ->where('status', 'finished')
        ->count();

    $saldo = $user->saldo ?? 0;

    $rating = \App\Models\Rating::where('worker_id', $user->id)
        ->avg('rating');

    $orders = \App\Models\Order::with('jasa','user')
        ->where('worker_id', $user->id)
        ->latest()
        ->limit(5)
        ->get();

    return view('pekerja.dashboard', compact(
        'orderBaru',
        'orderAktif',
        'orderSelesai',
        'saldo',
        'rating',
        'orders'
    ));
}

}

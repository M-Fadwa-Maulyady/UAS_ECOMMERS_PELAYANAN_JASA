<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Jasa;
use App\Models\Payment;
use App\Models\Rating;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::where('role', 'user')->count();
        $totalPekerja = User::where('role', 'pekerja')->count();
        $totalJasa = Jasa::count();

        $orderMasuk = Order::where('status', 'waiting_verification')->count();

        $totalTransaksi = Payment::where('status', 'done')
            ->sum('total');

        $ratingAvg = Rating::avg('rating');

        $orders = Order::with('user','jasa')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalPekerja',
            'totalJasa',
            'orderMasuk',
            'totalTransaksi',
            'ratingAvg',
            'orders'
        ));
    }
}

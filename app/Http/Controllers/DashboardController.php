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

}

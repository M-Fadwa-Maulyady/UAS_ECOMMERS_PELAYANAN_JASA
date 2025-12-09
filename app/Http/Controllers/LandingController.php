<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // ambil kategori yang punya jasa aktif (disetujui admin)
        $kategori = Kategori::whereHas('jasa', function($q) {
            $q->where('status', 1); // hanya jasa yang disetujui admin
        })->orderBy('nama')->get();

        // ambil jasa aktif saja
        $jasas = Jasa::where('status', 1)->latest()->get();

        return view('user.landing', compact('jasas', 'kategori'));
    }

    public function show($slug)
{
    $jasa = Jasa::where('slug', $slug)->where('status', 1)->firstOrFail();

    return view('user.jasa.show', compact('jasa'));
}

}

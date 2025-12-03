<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $jasas = Jasa::latest()->get();
        $kategori = Kategori::orderBy('nama')->get();

        return view('user.landing', compact('jasas', 'kategori'));
    }


    public function show($slug)
    {
        $jasa = Jasa::where('slug', $slug)->firstOrFail();
        return view('jasa.show', compact('jasa'));
    }
}

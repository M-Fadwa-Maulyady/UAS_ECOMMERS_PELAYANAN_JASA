<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LandingJasaController extends Controller
{
    public function index()
    {
        $jasas = Jasa::latest()->get();
        return view('welcome', compact('jasas'));
    }

    public function show($slug)
    {
        $jasa = Jasa::where('slug', $slug)->firstOrFail();
        return view('jasa.show', compact('jasa'));
    }
}


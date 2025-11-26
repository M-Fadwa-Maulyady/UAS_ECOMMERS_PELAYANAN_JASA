<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JasaController extends Controller
{
    // 🔹 Landing page (otomatis tampil semua jasa)
    public function index()
    {
        $jasas = Jasa::latest()->get();
        return view('home', compact('jasas')); // 👈 pastikan file view-nya: resources/views/home.blade.php
    }

    // 🔹 Halaman detail jasa
    public function show($slug)
    {
        $jasa = Jasa::where('slug', $slug)->firstOrFail();
        return view('jasa.show', compact('jasa')); // 👈 pastikan file view-nya: resources/views/jasa/show.blade.php
    }

    // 🔹 Form tambah jasa
    public function create()
    {
        return view('jasa.create');
    }

    // 🔹 Simpan jasa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga' => 'nullable|string',
            'durasi' => 'nullable|string',
            'kontak' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPath = $request->hasFile('gambar')
            ? $request->file('gambar')->store('uploads/jasa', 'public')
            : null;

        Jasa::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'kontak' => $request->kontak,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('landing')->with('success', 'Jasa berhasil ditambahkan!');
    }
}

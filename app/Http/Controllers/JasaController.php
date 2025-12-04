<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JasaController extends Controller
{
    public function index()
    {
        $jasa = Jasa::with('kategori')->get(); // include kategori
        return view('pekerja.manajemen-jasa.index', compact('jasa'));
    }

    public function create()
    {
        $kategoris = Kategori::all(); // ambil kategori
        return view('pekerja.manajemen-jasa.create', compact('kategoris'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_jasa' => 'required',
            'deskripsi' => 'required',
            'estimasi_waktu' => 'required|integer',
            'harga' => 'required|integer',
            'kategori_id' => 'required|integer|exists:kategoris,id',
            'gambar' => 'nullable|image'
        ]);

        $data = $request->all();

        // mapping field publik
        $data['nama'] = $request->nama_jasa;
        $data['slug'] = Str::slug($request->nama_jasa) . '-' . Str::random(6);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('jasa', 'public');
        }

        Jasa::create($data);

        return redirect()->route('pekerja.manajemen-jasa.index')
            ->with('success', 'Jasa berhasil ditambahkan');
    }



    public function edit($id)
    {
        $jasa = Jasa::findOrFail($id);
        $kategoris = Kategori::all(); // dikirim ke form edit
        return view('pekerja.manajemen-jasa.edit', compact('jasa', 'kategoris'));
    }



    public function update(Request $request, $id)
    {
        $jasa = Jasa::findOrFail($id);

        $request->validate([
            'nama_jasa' => 'required',
            'deskripsi' => 'required',
            'estimasi_waktu' => 'required|integer',
            'harga' => 'required|integer',
            'kategori_id' => 'required|integer|exists:kategoris,id',
            'gambar' => 'nullable|image'
        ]);

        $data = $request->all();

        // mapping field publik
        $data['nama'] = $request->nama_jasa;
        $data['slug'] = Str::slug($request->nama_jasa) . '-' . Str::random(6);

        if ($request->hasFile('gambar')) {
            if ($jasa->gambar) {
                Storage::disk('public')->delete($jasa->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('jasa', 'public');
        }

        $jasa->update($data);

        return redirect()->route('pekerja.manajemen-jasa.index')
            ->with('success', 'Jasa berhasil diperbarui');
    }



    public function destroy($id)
    {
        $jasa = Jasa::findOrFail($id);

        if ($jasa->gambar) {
            Storage::disk('public')->delete($jasa->gambar);
        }

        $jasa->delete();

        return redirect()->route('pekerja.manajemen-jasa.index')
            ->with('success', 'Jasa berhasil dihapus');
    }
}

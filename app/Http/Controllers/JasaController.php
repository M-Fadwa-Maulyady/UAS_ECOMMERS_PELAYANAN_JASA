<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JasaController extends Controller
{
    // Tampilkan semua jasa
    public function index()
    {
        $jasa = Jasa::all();
        return view('pekerja.manajemen-jasa.index', compact('jasa'));
    }

    public function create()
    {
        return view('pekerja.manajemen-jasa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jasa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'estimasi_waktu' => 'required|integer',
            'harga' => 'required|integer',
            'jumlah_revisi' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

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
        return view('pekerja.manajemen-jasa.edit', compact('jasa'));
    }

    public function update(Request $request, $id)
    {
        $jasa = Jasa::findOrFail($id);

        $request->validate([
            'nama_jasa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'estimasi_waktu' => 'required|integer',
            'harga' => 'required|integer',
            'jumlah_revisi' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

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

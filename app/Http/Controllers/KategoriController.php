<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $title = "Manajemen Kategori";
        $kategori = Kategori::orderBy('created_at', 'desc')->get();

        return view('admin.kategori.index', compact('title', 'kategori'));
    }

    public function create()
    {
        $title = "Tambah Kategori";
        return view('admin.kategori.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Kategori::create($request->only(['nama', 'deskripsi']));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $title = "Edit Kategori";
        $kategori = Kategori::findOrFail($id);

        return view('admin.kategori.edit', compact('title', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Kategori::findOrFail($id)->update($request->only(['nama', 'deskripsi']));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}

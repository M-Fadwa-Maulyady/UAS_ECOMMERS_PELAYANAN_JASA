<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'nama'       => 'required|string|max:255',
            'icon'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['nama']);

        // Upload icon jika ada
        if ($request->hasFile('icon')) {
            $filename = time() . '.' . $request->icon->extension();
            $request->icon->storeAs('kategori', $filename, 'public');
            $data['icon'] = $filename;
        }

        Kategori::create($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
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
            'nama'       => 'required|string|max:255',
            'icon'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $kategori = Kategori::findOrFail($id);
        $data = $request->only(['nama']);

        // Jika upload icon baru
        if ($request->hasFile('icon')) {

            // Hapus icon lama jika ada
            if ($kategori->icon && Storage::disk('public')->exists('kategori/' . $kategori->icon)) {
                Storage::disk('public')->delete('kategori/' . $kategori->icon);
            }

            $filename = time() . '.' . $request->icon->extension();
            $request->icon->storeAs('kategori', $filename, 'public');
            $data['icon'] = $filename;
        }

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Hapus icon dari storage
        if ($kategori->icon && Storage::disk('public')->exists('kategori/' . $kategori->icon)) {
            Storage::disk('public')->delete('kategori/' . $kategori->icon);
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}

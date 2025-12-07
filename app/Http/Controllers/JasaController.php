<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JasaController extends Controller
{
    /* ==========================
       PEKERJA – LIST JASA
    ========================== */
    public function index()
    {
        $jasa = Jasa::where('user_id', auth()->id())
                    ->orderBy('status', 'asc')
                    ->get();

        return view('pekerja.manajemen-jasa.index', compact('jasa'));
    }


    /* ==========================
       PEKERJA – FORM TAMBAH
    ========================== */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('pekerja.manajemen-jasa.create', compact('kategoris'));
    }


    /* ==========================
       PEKERJA – SIMPAN JASA
    ========================== */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image',
            'nama_jasa' => 'required',
            'deskripsi' => 'required',
            'estimasi_waktu' => 'required|numeric',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $path = $request->file('gambar')->store('jasa', 'public');

        Jasa::create([
            'user_id'        => auth()->id(),
            'nama_jasa'      => $request->nama_jasa,
            'slug'           => Str::slug($request->nama_jasa) . '-' . Str::random(5),
            'deskripsi'      => $request->deskripsi,
            'estimasi_waktu' => $request->estimasi_waktu,
            'harga'          => $request->harga,
            'kategori_id'    => $request->kategori_id,
            'gambar'         => $path,
            'status'         => 0,  // 0 = pending admin
        ]);

        return redirect()->route('pekerja.manajemen-jasa.index')
            ->with('success', 'Jasa berhasil diajukan! Menunggu persetujuan admin.');
    }


    /* ==========================
       PEKERJA – EDIT JASA
    ========================== */
    public function edit($id)
    {
        $jasa = Jasa::where('user_id', auth()->id())->findOrFail($id);
        $kategoris = Kategori::all();

        return view('pekerja.manajemen-jasa.edit', compact('jasa', 'kategoris'));
    }


    /* ==========================
       PEKERJA – UPDATE JASA
    ========================== */
    public function update(Request $request, $id)
    {
        $jasa = Jasa::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'nama_jasa' => 'required',
            'deskripsi' => 'required',
            'estimasi_waktu' => 'required|integer',
            'harga' => 'required|integer',
            'kategori_id' => 'required|integer|exists:kategoris,id',
            'gambar' => 'nullable|image'
        ]);

        $data = [
            'nama_jasa'      => $request->nama_jasa,
            'slug'           => Str::slug($request->nama_jasa) . '-' . Str::random(5),
            'deskripsi'      => $request->deskripsi,
            'estimasi_waktu' => $request->estimasi_waktu,
            'harga'          => $request->harga,
            'kategori_id'    => $request->kategori_id,
        ];

        if ($request->hasFile('gambar')) {
            if ($jasa->gambar) {
                Storage::disk('public')->delete($jasa->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('jasa', 'public');
        }

        // set ulang status menjadi pending jika edit
        $data['status'] = 0;

        $jasa->update($data);

        return redirect()->route('pekerja.manajemen-jasa.index')
            ->with('success', 'Jasa berhasil diperbarui dan menunggu persetujuan admin.');
    }


    /* ==========================
       PEKERJA – HAPUS JASA
    ========================== */
    public function destroy($id)
    {
        $jasa = Jasa::where('user_id', auth()->id())->findOrFail($id);

        if ($jasa->gambar) {
            Storage::disk('public')->delete($jasa->gambar);
        }

        $jasa->delete();

        return redirect()->route('pekerja.manajemen-jasa.index')
            ->with('success', 'Jasa berhasil dihapus');
    }


    /* ==========================
       ADMIN – LIST JASA
    ========================== */
    public function adminIndex()
    {
        $jasaList = Jasa::orderBy('status', 'asc')->get();
        return view('admin.jasa.index', compact('jasaList'));
    }


    /* ==========================
       ADMIN – APPROVE
    ========================== */
    public function approve($id)
    {
        $jasa = Jasa::findOrFail($id);
        $jasa->status = 1; // approved
        $jasa->alasan_tolak = null;
        $jasa->save();

        return back()->with('success', 'Jasa berhasil disetujui!');
    }


    /* ==========================
       ADMIN – REJECT
    ========================== */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string'
        ]);

        $jasa = Jasa::findOrFail($id);
        $jasa->status = 2; // rejected
        $jasa->alasan_tolak = $request->alasan;
        $jasa->save();

        return back()->with('success', 'Jasa berhasil ditolak.');
    }

    public function adminDetail($id)
    {
        $jasa = Jasa::with('user', 'kategori')->findOrFail($id);
        return view('admin.jasa.detail', compact('jasa'));
    }

}

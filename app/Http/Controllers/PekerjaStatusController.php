<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PekerjaStatusController extends Controller
{
    // ===============================
    // HALAMAN STATUS PEKERJA
    // ===============================
    public function index()
    {
        $user = Auth::user();
        return view('pekerja.account.status', compact('user'));
    }



    // ===============================
    // TAHAP 4 — UPLOAD KTP
    // ===============================

    public function ktpForm()
    {
        $user = Auth::user();
        return view('pekerja.account.ktp', compact('user'));
    }

    public function ktpUpload(Request $request)
    {
        $request->validate([
            'ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        // Simpan file
        $path = $request->file('ktp')->store('ktp', 'public');

        // Update database
        $user->ktp = $path;
        $user->save();

        return redirect()->route('pekerja.account.status')
                        ->with('success', 'KTP berhasil diupload!');
    }



    // ===============================
    // TAHAP 5 — LENGKAPI PROFIL
    // ===============================

    public function profileForm()
    {   
        $user = Auth::user();
        return view('pekerja.account.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'nama_usaha' => 'required',
            'kategori_jasa' => 'required',
            'deskripsi_jasa' => 'required',
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'nama_usaha' => $request->nama_usaha,
            'kategori_jasa' => $request->kategori_jasa,
            'deskripsi_jasa' => $request->deskripsi_jasa,
            'profile_filled' => true, // progress ✔
        ]);

        return redirect()->route('pekerja.account.status')
                        ->with('success', 'Profil berhasil diperbarui!');
    }

    public function rekeningForm()
{
    $user = Auth::user();
    return view('pekerja.account.rekening', compact('user'));
}

public function rekeningUpdate(Request $request)
{
    $request->validate([
        'rekening_bank' => 'required',
        'rekening_nama' => 'required',
        'rekening_nomor' => 'required|numeric',
    ]);

    $user = Auth::user();

    $user->update([
        'rekening_bank' => $request->rekening_bank,
        'rekening_nama' => $request->rekening_nama,
        'rekening_nomor' => $request->rekening_nomor,
        'rekening' => 1, // untuk checklist progress
    ]);

    return redirect()->route('pekerja.account.status')
        ->with('success', 'Rekening bank berhasil disimpan!');
}

public function submitVerification()
{
    $user = Auth::user();

    // Kalau belum lengkap, tolak
    if (!$user->ktp || !$user->profile_filled || 
        !$user->rekening_bank || !$user->rekening_nama || !$user->rekening_nomor) 
    {
        return back()->with('error', 'Lengkapi semua persyaratan terlebih dahulu!');
    }

    // Set status menjadi pending (2)
    $user->is_verified_by_admin = 2; 
    $user->save();

    return redirect()->route('pekerja.account.status')
        ->with('success', 'Verifikasi berhasil diajukan! Admin akan memeriksa dokumenmu.');
}


}

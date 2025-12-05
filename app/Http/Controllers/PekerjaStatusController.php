<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PekerjaStatusController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pekerja.account.status', compact('user'));
    }

    public function ktpForm()
    {
        return view('pekerja.account.ktp', ['user' => Auth::user()]);
    }

    public function ktpUpload(Request $request)
    {
        $request->validate([
            'ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();
        $path = $request->file('ktp')->store('ktp', 'public');

        $user->ktp = $path;
        $user->save();

        return redirect()->route('pekerja.account.status')
            ->with('success', 'KTP berhasil diupload!');
    }

    public function profileForm()
    {
        return view('pekerja.account.profile', ['user' => Auth::user()]);
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
            'profile_filled' => true,
        ]);

        return redirect()->route('pekerja.account.status')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function rekeningForm()
    {
        return view('pekerja.account.rekening', ['user' => Auth::user()]);
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
        ]);

        return redirect()->route('pekerja.account.status')
            ->with('success', 'Rekening bank berhasil disimpan!');
    }

    public function submitVerification()
    {
        $user = Auth::user();

        if (!$user->ktp || !$user->profile_filled || !$user->rekening_bank) {
            return back()->with('error', 'Lengkapi semua persyaratan terlebih dahulu!');
        }

        // KIRIM PERMINTAAN VERIFIKASI
        $user->is_verified_by_admin = false;   // tetap pending
  $user->verification_note = null;
      // reset alasan tolak
        // ROLE TIDAK DIUBAH

        $user->save();

        return redirect()->route('pekerja.account.status')
            ->with('success', 'Permintaan verifikasi berhasil dikirim! Menunggu pemeriksaan admin.');
    }
}

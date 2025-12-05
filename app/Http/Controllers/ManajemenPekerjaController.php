<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManajemenPekerjaController extends Controller
{
    public function index()
    {
        $title = "Manajemen Pekerja";

        // tampilkan semua pekerja sesuai role, urutkan berdasarkan status verifikasi
        $workers = User::where('role', 'pekerja')
            ->orderBy('is_verified_by_admin', 'asc')
            ->get();

        return view('admin.pekerja.index', compact('workers', 'title'));
    }

    public function show($id)
    {
        $title = "Detail Pekerja";
        $worker = User::findOrFail($id);

        return view('admin.pekerja.show', compact('worker', 'title'));
    }

    public function updateStatus(Request $request, $id)
    {
        $worker = User::findOrFail($id);

        if ($request->status === "approved") {

            $worker->is_verified_by_admin = 1;
            $worker->verification_note = null;

        } elseif ($request->status === "rejected") {

            $request->validate([
                'verification_note' => 'required|string'
            ]);

            $worker->is_verified_by_admin = 2;
            $worker->verification_note = $request->verification_note;
        }

        $worker->save();

        return redirect()->route('admin.pekerja.index')
            ->with('success', 'Status pekerja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return back()->with('success', 'Pekerja berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManajemenPekerjaController extends Controller
{
    public function index()
    {
        $title = "Manajemen Pekerja";
        $workers = User::where('role', 'worker')->latest()->get();

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
        $worker->status = $request->status;
        $worker->save();

        return redirect()->route('pekerja.show', $id)->with('success', 'Status pekerja berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('pekerja.index')->with('success', 'Pekerja berhasil dihapus!');
    }
}

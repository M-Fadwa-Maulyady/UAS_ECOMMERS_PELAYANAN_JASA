<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManajemenUserController extends Controller
{
    /**
     * Halaman Index (List User)
     */
    public function index()
    {
        $title = "Manajemen User";
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.manajemen_user.index', compact('users', 'title'));
    }

    /**
     * Halaman Form Tambah User
     */
    public function create()
    {
        $title = "Tambah User";
        return view('admin.manajemen_user.create', compact('title'));
    }

    /**
     * Simpan User Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('manajemen-user.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Halaman Form Edit User
     */
    public function edit($id)
    {
        $title = "Edit User";
        $user = User::findOrFail($id);

        return view('admin.manajemen_user.edit', compact('user', 'title'));
    }

    /**
     * Update User
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        // Update password jika diisi
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('manajemen-user.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Hapus User
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('manajemen-user.index')->with('success', 'User berhasil dihapus!');
    }
}

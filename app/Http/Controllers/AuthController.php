<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required','email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard')->with('success', 'Selamat Datang admin');
        }
        elseif (Auth::user()->role === 'pekerja') {
            return redirect()->route('pekerja.dashboard')->with('success','Selamat Datang pekerja');
        }
        else {
            return redirect()->route('landing')->with('success','Selamat Datang user');
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:100',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role'     => 'required|in:user,pekerja',
        'nama_usaha'     => 'nullable|string|max:255',
        'kategori_jasa'  => 'nullable|string|max:255',
        'deskripsi_jasa' => 'nullable|string|max:500',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
        'nama_usaha'     => $request->role === 'pekerja' ? $request->nama_usaha : null,
        'kategori_jasa'  => $request->role === 'pekerja' ? $request->kategori_jasa : null,
        'deskripsi_jasa' => $request->role === 'pekerja' ? $request->deskripsi_jasa : null,
    ]);

    return redirect()->route('login')->with('success','Registrasi berhasil, silakan login.');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success','Berhasil keluar.');
    }
}

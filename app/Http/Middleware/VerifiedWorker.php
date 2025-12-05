<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifiedWorker
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Jika belum login → arahkan ke login
        if (!$user) {
            return redirect()->route('login');
        }

        // Jika role bukan pekerja → cegah akses
        if ($user->role !== 'pekerja') {
            return redirect()->route('pekerja.account.status')
                ->with('error', 'Akun kamu bukan pekerja.');
        }

        // Jika pekerja tapi BELUM diverifikasi admin
        if (!$user->is_verified_by_admin) {
            return redirect()->route('pekerja.account.status')
                ->with('error', 'Akun kamu harus diverifikasi admin sebelum bisa mengelola jasa.');
        }

        return $next($request);
    }
}

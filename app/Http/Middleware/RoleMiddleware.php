<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles)
    {
        // User belum login → redirect login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil list role yang diizinkan
        $allowed = array_map('trim', explode(',', $roles));

        // Kalau role tidak sesuai → forbidden, TAPI jangan redirect!
        if (!in_array(Auth::user()->role, $allowed)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}

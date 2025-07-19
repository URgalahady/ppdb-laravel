<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    // Fungsi utama untuk memproses middleware
    public function handle(Request $request, Closure $next, $role)
    {
        // Memeriksa apakah user sudah login (auth check)
        if (!auth()->check()) {
            // Jika belum login, arahkan ke halaman login
            return redirect()->route('login');
        }

        // Memeriksa apakah role user saat ini sesuai dengan role yang diinginkan
        if (auth()->user()->role !== $role) {
            // Jika role user tidak sesuai, arahkan ke halaman home dengan pesan error
            return redirect()->route('home')
                   ->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        // Jika user sudah login dan role sesuai, lanjutkan proses ke middleware selanjutnya
        return $next($request);
    }
}

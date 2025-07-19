<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleUser
{
    // Fungsi utama untuk memproses middleware
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah user sudah login dan memiliki role 'user'
        if (Auth::check() && Auth::user()->role === 'user') {
            // Jika role user adalah 'user', lanjutkan ke middleware berikutnya
            return $next($request);
        }

        // Jika user tidak memiliki role 'user', arahkan ke halaman home dengan pesan error
        return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}

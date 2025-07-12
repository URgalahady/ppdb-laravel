<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->role !== $role) {
            return redirect()->route('home')
                   ->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}
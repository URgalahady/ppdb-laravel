<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        
        // Cek apakah pendaftaran sudah dilakukan
        $isRegistered = $user->pendaftaran && $user->pendaftaran->is_registered;

        return view('profile.show', compact('user', 'isRegistered'));
    }
    
}

<?php

// app/Http/Controllers/KontakController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Auth;

class KontakController extends Controller
{
    public function create()
    {
        return view('kontak.form'); 
    }

    public function store(Request $request) 
    {
        // Validasi input form
        $request->validate([
            'nama' => 'required|string|max:100',      
            'subjek' => 'required|string|max:255',    
            'pesan' => 'required|string',             
        ]);

        // Simpan data ke tabel `kontaks`
        Kontak::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,       
            'subjek' => $request->subjek,   
            'pesan' => $request->pesan,     
        ]);

        // Redirect kembali ke halaman form dengan pesan sukses
        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }
}
    
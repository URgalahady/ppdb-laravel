<?php

// app/Http/Controllers/KontakController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Auth;

class KontakController extends Controller
{
    public function create() // Menampilkan form kontak ke user
    {
        return view('kontak.form'); // Arahkan ke view kontak/form.blade.php
    }

    public function store(Request $request) // Menangani penyimpanan data pesan dari form kontak
    {
        // Validasi input form
        $request->validate([
            'nama' => 'required|string|max:100',      // Nama wajib diisi, maksimal 100 karakter
            'subjek' => 'required|string|max:255',    // Subjek wajib diisi, maksimal 255 karakter
            'pesan' => 'required|string',             // Pesan wajib diisi
        ]);

        // Simpan data ke tabel `kontaks`
        Kontak::create([
            'user_id' => Auth::id(),        // Ambil ID user yang sedang login
            'nama' => $request->nama,       // Simpan nama dari form
            'subjek' => $request->subjek,   // Simpan subjek dari form
            'pesan' => $request->pesan,     // Simpan isi pesan dari form
        ]);

        // Redirect kembali ke halaman form dengan pesan sukses
        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }
}
    
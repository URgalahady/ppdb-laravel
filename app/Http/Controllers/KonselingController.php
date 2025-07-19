<?php
namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonselingController extends Controller
{
    // Menampilkan form pengajuan konseling
    public function index() // Menampilkan halaman form pengajuan konseling
    {
        return view('konseling.index'); // Mengarahkan ke view 'konseling.index'
    }

    // Menyimpan pengajuan konseling
    public function store(Request $request) // Menyimpan data pengajuan konseling dari form
    {
        // Validasi input dari form
        $validated = $request->validate([
            'jenis' => 'required|string', // Field 'jenis' wajib diisi dan harus berupa teks
            'pesan' => 'required|string', // Field 'pesan' wajib diisi dan harus berupa teks
        ]);

        // Simpan pengajuan konseling ke database
        Konseling::create([
            'user_id' => Auth::id(), // Simpan ID pengguna yang sedang login
            'jenis' => $validated['jenis'], // Jenis konseling dari input
            'pesan' => $validated['pesan'], // Pesan konseling dari input
        ]);

        return redirect()->route('konseling.index') // Kembali ke halaman form
            ->with('success', 'Pengajuan konseling berhasil!'); // Tampilkan pesan sukses
    }

    // Menampilkan riwayat pengajuan konseling siswa
    public function riwayat() // Menampilkan semua riwayat konseling milik user yang login
    {
        $konselings = Konseling::where('user_id', Auth::id())->get(); // Ambil semua data konseling milik user
        return view('konseling.riwayat', compact('konselings')); // Kirim data ke view 'konseling.riwayat'
    }
}

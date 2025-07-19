<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    // Tampilkan semua gelombang
    public function index() // Menampilkan semua data gelombang dari database
    {
        $gelombangs = Gelombang::all(); // Ambil semua record dari tabel gelombang
        return view('admin.gelombang.index', compact('gelombangs')); // Kirim data ke view
    }

    // Simpan gelombang baru
    public function store(Request $request) // Fungsi untuk menyimpan data gelombang dari form
    {
        $request->validate([
            'nama' => 'required', // Nama wajib diisi
            'tanggal_mulai' => 'required|date', // Tanggal mulai wajib dan harus bertipe tanggal
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai' // Tanggal akhir wajib, harus tanggal, dan harus setelah tanggal mulai
        ]);

        Gelombang::create($request->all()); // Simpan data ke database

        return redirect()->route('admin.gelombang.index') // Redirect ke halaman gelombang
            ->with('success', 'Gelombang berhasil ditambahkan'); // Beri pesan sukses
    }

    // Toggle status aktif
    public function toggleAktif($id, $request ) // Fungsi untuk mengubah status aktif gelombang (aktif/nonaktif)
    {
        // Aktifkan/nonaktifkan gelombang ini
        $gelombang = Gelombang::find($id); // Cari gelombang berdasarkan ID
        $gelombang->is_active = $request; // Ubah status aktif berdasarkan input (1/0 atau true/false)
        $gelombang->save(); // Simpan perubahan

        return back()->with('success', 'Status gelombang berhasil diubah'); // Kembali ke halaman sebelumnya
    }

    public function destroy($id) // Fungsi untuk menghapus gelombang dari database
    {
        try {
            $gelombang = Gelombang::findOrFail($id); // Cari gelombang berdasarkan ID, jika tidak ditemukan akan error

            // Cek jika gelombang aktif
            if ($gelombang->is_active) { // Jika gelombang masih aktif, tidak boleh dihapus
                return redirect()->back()
                       ->with('error', 'Tidak bisa menghapus gelombang yang sedang aktif!');
            }

            // Cek jika ada pendaftaran
            if ($gelombang->pendaftarans()->exists()) { // Jika ada pendaftar terkait gelombang ini, tidak boleh dihapus
                return redirect()->back()
                       ->with('error', 'Tidak bisa menghapus karena sudah ada pendaftaran!');
            }

            $gelombang->delete(); // Hapus data gelombang dari database

            return redirect()->route('admin.gelombang.index') // Kembali ke halaman index
                   ->with('success', 'Gelombang berhasil dihapus'); // Beri pesan sukses

        } catch (\Exception $e) { // Jika ada error saat penghapusan
            return redirect()->back()
                   ->with('error', 'Gagal menghapus: ' . $e->getMessage()); // Tampilkan pesan error
        }
    }
}

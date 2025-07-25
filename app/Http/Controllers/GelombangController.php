<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    // Tampilkan semua gelombang
    public function index()
    {
        $gelombangs = Gelombang::all();
        return view('admin.gelombang.index', compact('gelombangs'));
    }

    // Simpan gelombang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Jika checkbox is_active dicentang, nonaktifkan yang lain terlebih dahulu
        if ($request->has('is_active')) {
            Gelombang::where('is_active', 1)->update(['is_active' => 0]);
        }

        Gelombang::create([
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil ditambahkan');
    }

    // Toggle status aktif gelombang
    public function toggleAktif($id)
    {
        $gelombang = Gelombang::findOrFail($id);

        // Nonaktifkan semua gelombang dulu
        Gelombang::where('is_active', true)->update(['is_active' => false]);

        // Aktifkan gelombang ini
        $gelombang->is_active = true;
        $gelombang->save();

        return redirect()->back()->with('success', 'Gelombang berhasil diaktifkan.');
    }

    // Hapus gelombang
    public function destroy($id)
    {
        try {
            $gelombang = Gelombang::findOrFail($id);

            if ($gelombang->is_active) {
                return redirect()->back()->with('error', 'Tidak bisa menghapus gelombang yang sedang aktif!');
            }

            if ($gelombang->pendaftarans()->exists()) {
                return redirect()->back()->with('error', 'Tidak bisa menghapus karena sudah ada pendaftaran!');
            }

            $gelombang->delete();

            return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
{
    // Validasi input untuk nama gelombang
    $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    // Cari gelombang berdasarkan ID
    $gelombang = Gelombang::findOrFail($id);

    // Perbarui hanya nama gelombang
    $gelombang->nama = $request->nama;

    // Simpan perubahan ke database
    $gelombang->save();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('admin.gelombang.index')->with('success', 'Nama Gelombang berhasil diperbarui');
}

}

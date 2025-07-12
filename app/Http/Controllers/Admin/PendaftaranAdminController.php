<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranAdminController extends Controller
{
    /**
     * Menampilkan Daftar Pendaftaran
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
                          ->latest()
                          ->get();
        
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Menampilkan Detail Pendaftaran
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
                         ->findOrFail($id);
                         
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Menghapus Data Pendaftaran
     */
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Hapus file terkait jika ada
        foreach (['foto', 'ijazah', 'akta'] as $field) {
            if ($pendaftaran->$field) {
                \Storage::disk('public')->delete($pendaftaran->$field);
            }
        }
        
        $pendaftaran->delete();

        return redirect()
               ->route('admin.pendaftaran.index')
               ->with('success', 'Pendaftaran berhasil dihapus.');
    }

    /**
     * Memperbarui Tahap Pendaftaran
     */
    public function updateTahap(Request $request, $id)
    {
        $validated = $request->validate([
            'tahap' => 'required|in:belum,administrasi,tes_akademik,wawancara,selesai'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($validated);

        return redirect()
               ->route('admin.pendaftaran.show', $id)
               ->with('success', 'Tahap pendaftaran berhasil diperbarui.');
    }
}
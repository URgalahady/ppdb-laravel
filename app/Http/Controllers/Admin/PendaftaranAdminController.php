<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Gelombang;
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
    $gelombangAktif = Gelombang::where('is_active', 1)->whereDate('tanggal_mulai', '<=', date('Y-m-d'))
    ->whereDate('tanggal_berakhir', '>=', date('Y-m-d'))->get();
        
        
        return view('admin.pendaftaran.index', compact('pendaftarans', 'gelombangAktif'));
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
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

     $gelombangAktif = Gelombang::where('is_active', 1)
    ->orderBy('id', 'asc')
    ->get();

        

        
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
        
        // Menghapus file terkait jika ada
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
    

    /**
     * Menampilkan Daftar Pendaftar Berdasarkan Status
     */
// PendaftaranAdminController.php

public function byStatus()
{
    $menunggu = Pendaftaran::where('status', 'menunggu')->with(['user', 'jurusan', 'gelombang'])->get();
    $diterima = Pendaftaran::where('status', 'diterima')->with(['user', 'jurusan', 'gelombang'])->get();
    $ditolak  = Pendaftaran::where('status', 'ditolak')->with(['user', 'jurusan', 'gelombang'])->get();

    return view('admin.pendaftaran.byStatus', compact('menunggu', 'diterima', 'ditolak'));
}

public function byGelombang(Request $request)
{
    $gelombangId = $request->input('gelombang_id', 1); // Default gelombang jika tidak ada filter

    $gelombangs = Gelombang::all();
    $pendaftarans = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
        ->where('gelombang_id', $gelombangId)
        ->latest()
        ->get();

    return view('admin.pendaftaran.byGelombang', compact('pendaftarans', 'gelombangs', 'gelombangId'));
}
public function updateStatus(Request $request, $id)
{
    // Validasi input status
    $validated = $request->validate([
        'status' => 'required|in:menunggu,diterima,ditolak',
    ]);

    // Ambil data pendaftaran
    $pendaftaran = Pendaftaran::findOrFail($id);
    $status = $validated['status'];

    if ($status === 'ditolak') {
        // Set status ke 'ditolak'
        $pendaftaran->status = 'ditolak';

        // Cek apakah pendaftar ada di gelombang 1 atau gelombang 2
        $gelombangs = Gelombang::where('is_active', 1)->orderBy('tanggal_mulai')->get();

        // Cek apakah pendaftar ada di gelombang pertama atau kedua
        if ($pendaftaran->gelombang_id == $gelombangs[0]->id || $pendaftaran->gelombang_id == $gelombangs[1]->id) {
            // Arahkan pendaftar ke formulir pendaftaran untuk mengisi ulang (formulir di gelombang berikutnya)
            $nextGelombang = $gelombangs->first(function ($gelombang) use ($pendaftaran) {
                return $gelombang->id > $pendaftaran->gelombang_id;
            });

            if ($nextGelombang) {
                // Update gelombang pendaftar dan set status ke 'menunggu' lagi
                $pendaftaran->gelombang_id = $nextGelombang->id;
                $pendaftaran->status = 'menunggu'; // Reset status ke menunggu untuk pendaftaran ulang
                $pendaftaran->save();

                // Arahkan user ke halaman formulir untuk mengisi ulang (tanpa menghapus data yang sudah ada)
                return redirect()->route('formulir.create')
                    ->with('success', 'Pendaftaran Anda telah ditolak. Silakan mengisi formulir ulang di gelombang berikutnya.');
            }
        }
    }

    // Update status selain 'ditolak'
    $pendaftaran->status = $status;
    $pendaftaran->save();

    return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
}
    
// Tampilkan halaman konfirmasi
}
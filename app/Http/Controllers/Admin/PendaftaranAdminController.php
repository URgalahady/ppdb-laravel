<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranAdminController extends Controller
{
    // Menampilkan Daftar Pendaftaran
    public function index()
    {
        $pendaftarans = Pendaftaran::all();
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    // Menampilkan Detail Pendaftaran
    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    // Menambahkan method destroy untuk menghapus data
    public function destroy($id)
    {
        // Temukan data pendaftaran berdasarkan ID
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Hapus data pendaftaran
        $pendaftaran->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }
    
}

 
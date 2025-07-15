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
            'nama' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai'
        ]);

        Gelombang::create($request->all());

        return redirect()->route('admin.gelombang.index')
            ->with('success', 'Gelombang berhasil ditambahkan');
    }

    // Toggle status aktif
    public function toggleAktif($id, $request )
    {

        // Aktifkan/nonaktifkan gelombang ini
        $gelombang = Gelombang::find($id);
        $gelombang->is_active = $request;
        $gelombang->save();

        return back()->with('success', 'Status gelombang berhasil diubah');
    }
    public function destroy($id)
{
    try {
        $gelombang = Gelombang::findOrFail($id);
        
        // Cek jika gelombang aktif
        if ($gelombang->is_active) {
            return redirect()->back()
                   ->with('error', 'Tidak bisa menghapus gelombang yang sedang aktif!');
        }
        
        // Cek jika ada pendaftaran
        if ($gelombang->pendaftarans()->exists()) {
            return redirect()->back()
                   ->with('error', 'Tidak bisa menghapus karena sudah ada pendaftaran!');
        }
        
        $gelombang->delete();
        
        return redirect()->route('admin.gelombang.index')
               ->with('success', 'Gelombang berhasil dihapus');
               
    } catch (\Exception $e) {
        return redirect()->back()
               ->with('error', 'Gagal menghapus: ' . $e->getMessage());
    }
}
}

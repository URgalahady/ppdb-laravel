<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    // Menampilkan semua gelombang
    public function index()
    {
        $gelombangs = Gelombang::latest()->get();
        return view('admin.gelombang.index', compact('gelombangs'));
    }

    // Form tambah gelombang
    public function create()
    {
        return view('admin.gelombang.create');
    }

    // Simpan gelombang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai'
        ]);

        Gelombang::create($request->all());

        return redirect()->route('admin.gelombang.index')
            ->with('success', 'Gelombang berhasil ditambahkan');
    }

    // Form edit gelombang
    public function edit(Gelombang $gelombang)
    {
        return view('admin.gelombang.edit', compact('gelombang'));
    }

    // Update gelombang
    public function update(Request $request, Gelombang $gelombang)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai'
        ]);

        $gelombang->update($request->all());

        return redirect()->route('admin.gelombang.index')
            ->with('success', 'Gelombang berhasil diperbarui');
    }

    // Hapus gelombang
    public function destroy(Gelombang $gelombang)
    {
        $gelombang->delete();

        return redirect()->route('admin.gelombang.index')
            ->with('success', 'Gelombang berhasil dihapus');
    }

    // Toggle status aktif
    public function toggleAktif($id)
    {
        // Nonaktifkan semua gelombang lain
        Gelombang::where('id', '!=', $id)->update(['is_active' => false]);

        // Toggle status gelombang yang dipilih
        $gelombang = Gelombang::find($id);
        $gelombang->is_active = !$gelombang->is_active;
        $gelombang->save();

        return back()->with('success', 'Status gelombang berhasil diubah');
    }
}
<?php
namespace App\Http\Controllers\Admin;

use App\Models\Konseling;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonselingAdminController extends Controller
{
    // Menampilkan semua pengajuan konseling
    public function index()
    {
        $konselings = Konseling::with('user')->get();  // Mengambil semua pengajuan konseling
        return view('admin.konseling.index', compact('konselings'));
    }

    // Menampilkan detail pengajuan konseling
    public function show($id)
    {
        $konseling = Konseling::findOrFail($id);  // Menampilkan data pengajuan berdasarkan ID
        return view('admin.konseling.show', compact('konseling'));
    }

    // Mengupdate status dan tanggapan pengajuan konseling
    public function update(Request $request, $id)
    {
        $konseling = Konseling::findOrFail($id);  // Menampilkan data pengajuan berdasarkan ID

        // Validasi input untuk tanggapan dan status
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
            'tanggapan' => 'nullable|string',
        ]);

        // Update status dan tanggapan pengajuan
        $konseling->update([
            'status' => $validated['status'],
            'tanggapan' => $validated['tanggapan'] ?? null,
        ]);

        return redirect()->route('admin.konseling.index')->with('success', 'Status dan tanggapan konseling berhasil diperbarui.');
    }
}

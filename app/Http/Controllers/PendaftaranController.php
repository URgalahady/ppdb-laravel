<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\Gelombang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    // ... (method create() dan store() tetap sama)

    // Menampilkan data pendaftaran user
    public function show()
    {
        $data = auth()->user()->pendaftaran;

        if (!$data) {
            return redirect()->route('formulir.create')->with('info', 'Anda belum mengisi formulir pendaftaran.');
        }

        return view('pendaftaran.show', [
            'data' => $data,
            'gelombang' => $data->gelombang
        ]);
    }

    /**
     * Menampilkan form edit pendaftaran
     */
    public function edit()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login');
            }

            $pendaftaran = $user->pendaftaran;
            
            if (!$pendaftaran) {
                return redirect()->route('formulir.create')
                       ->with('error', 'Anda belum memiliki data pendaftaran');
            }

            // Validasi status
            if ($pendaftaran->status === 'diterima') {
                return redirect()->route('formulir.show')
                       ->with('error', 'Data tidak bisa diedit karena sudah diterima');
            }

            // Validasi masa edit

             if (\Carbon\Carbon::parse($pendaftaran->gelombang->tanggal_berakhir) < now()) {
        return redirect()->route('formulir.show')
               ->with('error', 'Masa edit sudah berakhir pada: ' 

               . \Carbon\Carbon::parse($pendaftaran->gelombang->tanggal_berakhir)->format('d-m-Y'));
            }

            $jurusans = Jurusan::where('penuh', false)
                        ->orWhere('id', $pendaftaran->jurusan_id)
                        ->get();

            return view('pendaftaran.edit', [
                'pendaftaran' => $pendaftaran,
                'jurusans' => $jurusans,
                'gelombang' => $pendaftaran->gelombang
            ]);

        } catch (\Exception $e) {
            return redirect()->route('formulir.show')
                   ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menyimpan perubahan pendaftaran
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $pendaftaran = $user->pendaftaran;

            if (!$pendaftaran) {
                throw new \Exception('Data pendaftaran tidak ditemukan');
            }

            // Validasi status
            if ($pendaftaran->status === 'diterima') {
                throw new \Exception('Data tidak dapat diubah karena sudah diterima');
            }

            // Validasi masa edit
            if ($pendaftaran->gelombang->tanggal_berakhir < now()) {
                throw new \Exception('Masa edit sudah berakhir');
            }

            // Validasi input
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'asal_sekolah' => 'required|string|max:255',
                'jurusan_id' => 'required|exists:jurusans,id',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
                'ijazah' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
                'akta' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            // Handle perubahan jurusan
            if ($request->jurusan_id != $pendaftaran->jurusan_id) {
                $this->handleJurusanChange($pendaftaran, $validated['jurusan_id']);
            }

            // Handle file upload
            foreach (['foto', 'ijazah', 'akta'] as $field) {
                if ($request->hasFile($field)) {
                    // Hapus file lama jika ada
                    if ($pendaftaran->$field) {
                        Storage::disk('public')->delete($pendaftaran->$field);
                    }
                    // Simpan file baru
                    $validated[$field] = $request->file($field)
                        ->store("uploads/{$field}", 'public');
                }
            }

            $pendaftaran->update($validated);
            DB::commit();

            return redirect()->route('formulir.show')
                   ->with('success', 'Data berhasil diperbarui!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->validator)->withInput();
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Helper untuk handle perubahan jurusan
     */
    protected function handleJurusanChange($pendaftaran, $newJurusanId)
    {
        DB::transaction(function () use ($pendaftaran, $newJurusanId) {
            $jurusanBaru = Jurusan::lockForUpdate()->findOrFail($newJurusanId);
            
            if ($jurusanBaru->penuh) {
                throw new \Exception('Jurusan yang dipilih sudah penuh');
            }

            // Kembalikan kuota jurusan lama
            if ($pendaftaran->jurusan_id) {
                $jurusanLama = Jurusan::lockForUpdate()->find($pendaftaran->jurusan_id);
                if ($jurusanLama) {
                    $jurusanLama->kuota += 1;
                    $jurusanLama->penuh = false;
                    $jurusanLama->save();
                }
            }

            // Kurangi kuota jurusan baru
            $jurusanBaru->kuota -= 1;
            $jurusanBaru->penuh = ($jurusanBaru->kuota <= 0);
            $jurusanBaru->save();
        });
    }
    /**
 * Update status pendaftaran (untuk admin)
 */
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:menunggu,diterima,ditolak'
    ]);

    try {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Update status
        $pendaftaran->status = $request->status;
        
        // Jika ditolak, set bisa daftar ulang
        if ($request->status == 'ditolak') {
            $pendaftaran->bisa_daftar_ulang = true;
        } else {
            $pendaftaran->bisa_daftar_ulang = false;
        }

        $pendaftaran->save();

        return back()->with('success', 'Status berhasil diperbarui!');

    } catch (\Exception $e) {
        return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
    }
}

    // ... (method lainnya tetap sama)
}
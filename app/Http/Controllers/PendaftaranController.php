<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\Gelombang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    // Menampilkan form pendaftaran
    public function create()
    {
        // Cek apakah user sudah mendaftar
        if (auth()->user()->pendaftaran) {
            return redirect()->route('formulir.show');
        }

        // Cek apakah ada gelombang aktif
        $gelombangAktif = Gelombang::where('is_active', true)->first();
        if (!$gelombangAktif) {
            return redirect()->route('home')->with('error', 'Tidak ada gelombang pendaftaran yang aktif saat ini.');
        }

        // Ambil jurusan yang belum penuh
        $jurusans = Jurusan::where('penuh', false)->get();
        return view('pendaftaran.form', compact('jurusans', 'gelombangAktif'));
    }

    // Menyimpan data pendaftaran baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'gelombang_id' => 'required|exists:gelombangs,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ijazah' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'akta' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        // Cek gelombang aktif
        $gelombang = Gelombang::findOrFail($request->gelombang_id);
        if (!$gelombang->is_active) {
            return back()->with('error', 'Gelombang pendaftaran tidak aktif.');
        }

        // Cek apakah pendaftaran sudah pernah dilakukan di gelombang ini
        $existingPendaftaran = Pendaftaran::where('user_id', auth()->id())
                                        ->where('gelombang_id', $gelombang->id)
                                        ->first();
        if ($existingPendaftaran) {
            return back()->with('error', 'Anda sudah terdaftar di gelombang ini.');
        }

        // Ambil data user dan jurusan
        $user = auth()->user();
        $jurusan = Jurusan::findOrFail($request->jurusan_id);

        // Cek apakah kuota jurusan sudah penuh
        if ($jurusan->penuh || $jurusan->kuota <= 0) {
            return back()->with('error', 'Jurusan yang dipilih sudah penuh.');
        }

        // Simpan data pendaftaran
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['status'] = 'menunggu';
        $data['tahap'] = 'belum';

        // Menyimpan file
        $data['foto'] = $request->file('foto')->store('uploads/foto', 'public');
        $data['ijazah'] = $request->file('ijazah')->store('uploads/ijazah', 'public');
        $data['akta'] = $request->file('akta')->store('uploads/akta', 'public');

        // Simpan data pendaftaran ke database
        Pendaftaran::create($data);

        // Update kuota jurusan
        $jurusan->kuota -= 1;
        if ($jurusan->kuota <= 0) {
            $jurusan->penuh = true;
        }
        $jurusan->save();

        return redirect()->route('formulir.show')->with('success', 'Formulir pendaftaran berhasil disimpan!');
    }

    // Menampilkan data pendaftaran user
    public function show()
    {
        $data = auth()->user()->pendaftaran;

        if (!$data) {
            return redirect()->route('formulir.create')->with('info', 'Anda belum mengisi formulir pendaftaran.');
        }

        $isRegistered = true;
        $gelombang = $data->gelombang;

        return view('pendaftaran.show', compact('data', 'isRegistered', 'gelombang'));
    }

    // Form edit pendaftaran
    public function edit()
    {
        $pendaftaran = Auth::user()->pendaftaran;

        if (!$pendaftaran) {
            return redirect()->route('formulir.create')->with('error', 'Anda belum mengisi formulir pendaftaran.');
        }

        // Jika status sudah diterima, data tidak bisa diubah
        if ($pendaftaran->status === 'diterima') {
            return redirect()->route('formulir.show')->with('error', 'Data tidak dapat diedit karena sudah diterima.');
        }

        // Jika gelombang sudah berakhir, tidak bisa edit
        if ($pendaftaran->gelombang->tanggal_berakhir < now()) {
            return redirect()->route('formulir.show')->with('error', 'Tidak dapat mengedit data karena gelombang pendaftaran sudah berakhir.');
        }

        $jurusans = Jurusan::where('penuh', false)->orWhere('id', $pendaftaran->jurusan_id)->get();
        $gelombangAktif = $pendaftaran->gelombang;

        return view('pendaftaran.edit', compact('pendaftaran', 'jurusans', 'gelombangAktif'));
    }

    // Menyimpan perubahan pendaftaran
    public function update(Request $request)
    {
        $pendaftaran = Auth::user()->pendaftaran;

        if (!$pendaftaran) {
            abort(404, 'Data pendaftaran tidak ditemukan.');
        }

        // Jika status sudah diterima, data tidak bisa diubah
        if ($pendaftaran->status === 'diterima') {
            return redirect()->route('formulir.show')->with('error', 'Data tidak dapat diupdate karena sudah diterima.');
        }

        // Jika gelombang sudah berakhir, tidak bisa edit
        if ($pendaftaran->gelombang->tanggal_berakhir < now()) {
            return redirect()->route('formulir.show')->with('error', 'Tidak dapat mengupdate data karena gelombang pendaftaran sudah berakhir.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ijazah' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'akta' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        // Ganti jurusan jika dipilih berbeda
        if ($request->jurusan_id != $pendaftaran->jurusan_id) {
            $jurusanBaru = Jurusan::findOrFail($request->jurusan_id);
            if ($jurusanBaru->penuh || $jurusanBaru->kuota <= 0) {
                return back()->with('error', 'Jurusan yang dipilih sudah penuh.');
            }

            // Update kuota jurusan lama
            $jurusanLama = Jurusan::find($pendaftaran->jurusan_id);
            if ($jurusanLama) {
                $jurusanLama->kuota += 1;
                $jurusanLama->penuh = false;
                $jurusanLama->save();
            }

            // Update kuota jurusan baru
            $jurusanBaru->kuota -= 1;
            if ($jurusanBaru->kuota <= 0) {
                $jurusanBaru->penuh = true;
            }
            $jurusanBaru->save();

            $validatedData['jurusan_id'] = $jurusanBaru->id;
        }

        // Update file jika ada
        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($pendaftaran->foto);
            $validatedData['foto'] = $request->file('foto')->store('uploads/foto', 'public');
        }

        if ($request->hasFile('ijazah')) {
            Storage::disk('public')->delete($pendaftaran->ijazah);
            $validatedData['ijazah'] = $request->file('ijazah')->store('uploads/ijazah', 'public');
        }

        if ($request->hasFile('akta')) {
            Storage::disk('public')->delete($pendaftaran->akta);
            $validatedData['akta'] = $request->file('akta')->store('uploads/akta', 'public');
        }

        $pendaftaran->update($validatedData);

        return redirect()->route('formulir.show')->with('success', 'Data pendaftaran berhasil diperbarui!');
    }

    // Pendaftaran ulang untuk siswa yang ditolak
    public function daftarUlang()
    {
        $pendaftaranLama = Auth::user()->pendaftaran()
            ->where('status', 'ditolak')
            ->where('bisa_daftar_ulang', true)
            ->latest()
            ->first();

        if (!$pendaftaranLama) {
            return redirect()->route('formulir.show')->with('error', 'Anda tidak bisa mendaftar ulang.');
        }

        // Cek gelombang aktif
        $gelombangAktif = Gelombang::where('is_active', true)->first();
        if (!$gelombangAktif) {
            return redirect()->route('formulir.show')->with('error', 'Tidak ada gelombang aktif untuk pendaftaran ulang.');
        }

        // Buat pendaftaran baru
        $pendaftaranBaru = $pendaftaranLama->replicate();
        $pendaftaranBaru->gelombang_id = $gelombangAktif->id;
        $pendaftaranBaru->status = 'menunggu';
        $pendaftaranBaru->tahap = 'belum';
        $pendaftaranBaru->bisa_daftar_ulang = false;
        $pendaftaranBaru->save();

        // Update status pendaftaran lama
        $pendaftaranLama->update(['bisa_daftar_ulang' => false]);

        return redirect()->route('formulir.show')->with('success', 'Pendaftaran ulang berhasil!');
    }

    // Admin memperbarui status pendaftaran
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        
        // Jika status ditolak, set bisa_daftar_ulang
        if ($request->status == 'ditolak') {
            $pendaftaran->bisa_daftar_ulang = true;
        } else {
            $pendaftaran->bisa_daftar_ulang = false;
        }

        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    // Menampilkan semua data pendaftaran (admin)
    public function index()
    {
        $pendaftarans = Pendaftaran::with('jurusan', 'user', 'gelombang')->latest()->get();
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    // Menampilkan tracking status pendaftaran
    public function tracking()
    {
        $data = auth()->user()->pendaftaran;

        if (!$data) {
            return redirect()->route('formulir.create')->with('info', 'Silakan isi formulir terlebih dahulu.');
        }

        $status = $data->status ?? 'belum_mendaftar';
        $gelombang = $data->gelombang;

        return view('pendaftaran.tracking', compact('data', 'status', 'gelombang'));
    }

    // Update tahap pendaftaran
    public function updateTahap(Request $request, $id)
    {
        $request->validate([
            'tahap' => 'required|in:belum,administrasi,tes_akademik,wawancara,selesai'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->tahap = $request->tahap;
        $pendaftaran->save();

        return back()->with('success', 'Tahap berhasil diperbarui.');
    }
}
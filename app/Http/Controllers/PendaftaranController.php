<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    // Menampilkan form pendaftaran
    public function create()
    {
        if (auth()->user()->pendaftaran) {
            return redirect()->route('formulir.show');
        }

        $jurusans = Jurusan::where('penuh', false)->get();
        return view('pendaftaran.form', compact('jurusans'));
    }

    // Menyimpan data pendaftaran baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ijazah' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'akta' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        $jurusan = Jurusan::findOrFail($request->jurusan_id);

        if ($jurusan->penuh || $jurusan->kuota <= 0) {
            return back()->with('error', 'Jurusan yang dipilih sudah penuh.');
        }

        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['status'] = 'menunggu';
        $data['foto'] = $request->file('foto')->store('uploads/foto', 'public');
        $data['ijazah'] = $request->file('ijazah')->store('uploads/ijazah', 'public');
        $data['akta'] = $request->file('akta')->store('uploads/akta', 'public');

        Pendaftaran::create($data);

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

        return view('pendaftaran.show', compact('data'));
    }

    // Form edit pendaftaran
   public function edit()
{
    $pendaftaran = Auth::user()->pendaftaran;

    if (!$pendaftaran) {
        return redirect()->route('formulir.create')->with('error', 'Anda belum mengisi formulir pendaftaran.');
    }

    // Cek status
    if ($pendaftaran->status === 'diterima') {
        return redirect()->route('formulir.show')->with('error', 'Data tidak dapat diedit karena sudah diterima.');
    }

    $jurusans = Jurusan::where('penuh', false)->orWhere('id', $pendaftaran->jurusan_id)->get();

    return view('pendaftaran.edit', compact('pendaftaran', 'jurusans'));
}

    // Menyimpan perubahan pendaftaran
    public function update(Request $request)
{
    $pendaftaran = Auth::user()->pendaftaran;

    if (!$pendaftaran) {
        abort(404, 'Data pendaftaran tidak ditemukan.');
    }

    // Cek status
    if ($pendaftaran->status === 'diterima') {
        return redirect()->route('formulir.show')->with('error', 'Data tidak dapat diupdate karena sudah diterima.');
    }

    // Validasi dan proses update tetap seperti sebelumnya...


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

            $jurusanLama = Jurusan::find($pendaftaran->jurusan_id);
            if ($jurusanLama) {
                $jurusanLama->kuota += 1;
                $jurusanLama->penuh = false;
                $jurusanLama->save();
            }

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

    // Admin memperbarui status pendaftaran
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return back()->with('success', 'Status pendaftaran diperbarui.');
    }
    public function index()
{
    // Hanya untuk admin: tampilkan semua data pendaftaran
    $pendaftarans = Pendaftaran::with('jurusan', 'user')->latest()->get();
    return view('admin.pendaftaran.index', compact('pendaftarans'));
}
public function tracking()
{
    $data = auth()->user()->pendaftaran;

    if (!$data) {
        return redirect()->route('formulir.create')->with('info', 'Silakan isi formulir terlebih dahulu.');
    }

    return view('pendaftaran.tracking', compact('data'));
}
public function updateTahap(Request $request, $id)
{
    $request->validate([
        'tahap' => 'required|in:administrasi,penilaian,wawancara,selesai'
    ]);

    $pendaftaran = Pendaftaran::findOrFail($id);
    $pendaftaran->tahap = $request->tahap;
    $pendaftaran->save();

    return back()->with('success', 'Tahap berhasil diperbarui.');
}


}

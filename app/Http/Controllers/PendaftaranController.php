<?php
namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\Gelombang;
use Illuminate\Support\Facades\Auth;
use App\Models\Tracking;
use Illuminate\Support\Facades\Storage;


class PendaftaranController extends Controller
{
   public function create()
{
    $user = auth()->user(); // Dapatkan user yang sedang login

    if ($user->pendaftaran) {
        return redirect()->route('formulir.show'); // Jika sudah mendaftar, langsung ke halaman show
    }

    // Cek apakah ada gelombang aktif
    $gelombangAktif = Gelombang::where('is_active', 1)
        ->first();


        
    if (!$gelombangAktif) {
        return redirect()->route('home')->with('error', 'Tidak ada gelombang pendaftaran yang aktif saat ini.');
    }

    $pendaftaran = $user->pendaftaran;

    // Jika sudah pernah mendaftar dan statusnya bukan 'ditolak', arahkan ke halaman show
    if ($pendaftaran && $pendaftaran->status !== 'ditolak') {
        return redirect()->route('formulir.show');
    }

    // Kalau sudah ditolak tapi masih di gelombang yang sama, jangan izinkan
    if ($pendaftaran && $pendaftaran->status === 'ditolak' && $pendaftaran->gelombang_id == $gelombangAktif->id) {
        return redirect()->route('formulir.show')->with('error', 'Anda sudah ditolak di gelombang ini. Silakan tunggu gelombang berikutnya.');
    }

    // Ambil jurusan yang belum penuh
    $jurusans = Jurusan::where('penuh', false)->get();
    return view('pendaftaran.form', compact('jurusans', 'gelombangAktif'));
}


    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
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
        if ($existingPendaftaran && $existingPendaftaran->status != 'ditolak') {
            return back()->with('error', 'Anda sudah terdaftar di gelombang ini.');
        }

        // Ambil data user dan jurusan
        $user = auth()->user();

         
           $gelombangAktif = Gelombang::where('is_active', 1 )
        ->first();

        

         if (!$gelombangAktif) {
        return redirect()->route('home')->with('error', 'Tidak ada gelombang pendaftaran yang aktif saat ini.');
            
    }


        $jurusan = Jurusan::findOrFail($request->jurusan_id);

        // Simpan data pendaftaran
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['status'] = 'menunggu'; // Status pendaftaran masih menunggu
        $data['tahap'] = 'belum';

        // Menyimpan file foto, ijazah, dan akta ke storage
        $data['foto'] = $request->file('foto')->store('uploads/foto', 'public');
        $data['ijazah'] = $request->file('ijazah')->store('uploads/ijazah', 'public');
        $data['akta'] = $request->file('akta')->store('uploads/akta', 'public');

        // Update kuota jurusan
        $jurusan->kuota -= 1;
        if ($jurusan->kuota <= 0) {
            $jurusan->penuh = true; // Tandai jurusan penuh jika kuota habis
        }
        $jurusan->save();
        

        

        // Simpan pendaftaran
        Pendaftaran::create($data);

        return redirect()->route('formulir.show')->with('success', 'Formulir pendaftaran berhasil disimpan!');
        
    }

    // Menampilkan data pendaftaran user
    public function show()
    {
        $data = auth()->user()->pendaftaran;
         $isRegistered = true; // karena show() hanya dipanggil jika sudah daftar
        $gelombang = $data->gelombang;

        // Jika belum ada data pendaftaran, arahkan ke form
        if (!$data) {
            return redirect()->route('formulir.create')->with('info', 'Anda belum mengisi formulir pendaftaran.');
        }

           
        if($data->status=='ditolak') 
        {   
            return view('pendaftaran.show', compact('data', 'isRegistered', 'gelombang'))->with('error', 'Mohon maaf pendaftaran anda telah dtiolak mohon mendaftara di gelombang berikutnya');
        }
         if($data->status=='diterima') 
        {   
            return view('pendaftaran.show', compact('data', 'isRegistered', 'gelombang'))->with('succes', 'Selamat anda telah diterima silahkan tunggu info selanjutnya');
        }

    

        return view('pendaftaran.show', compact('data', 'isRegistered', 'gelombang'));
    }

    // Form edit pendaftaran
    public function edit()
    {
        $pendaftaran = Auth::user()->pendaftaran;

        // Jika tidak ada pendaftaran, arahkan ke halaman formulir
        if (!$pendaftaran) {
            return redirect()->route('formulir.create')->with('error', 'Anda belum mengisi formulir pendaftaran.');
        }

        // Jika gelombang sudah berakhir, tidak bisa edit
        if ($pendaftaran->gelombang->tanggal_berakhir < now()) {
            return redirect()->route('formulir.show')->with('error', 'Tidak dapat mengedit data karena gelombang pendaftaran sudah berakhir.');
        }

        // Ambil jurusan yang tersedia untuk pengeditan (termasuk jurusan yang sudah dipilih)
        $jurusans = Jurusan::where('penuh', false)->orWhere('id', $pendaftaran->jurusan_id)->get();
        $gelombangAktif = $pendaftaran->gelombang;

        return view('pendaftaran.edit', compact('pendaftaran', 'jurusans', 'gelombangAktif'));
    }

    // Menyimpan perubahan pendaftaran
   public function update(Request $request)
{
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

    $pendaftaran = Auth::user()->pendaftaran;

    // Upload file jika ada
    if ($request->hasFile('foto')) {
        $validatedData['foto'] = $request->file('foto')->store('uploads/foto', 'public');
    }

    if ($request->hasFile('ijazah')) {
        $validatedData['ijazah'] = $request->file('ijazah')->store('uploads/ijazah', 'public');
    }

    if ($request->hasFile('akta')) {
        $validatedData['akta'] = $request->file('akta')->store('uploads/akta', 'public');
    }

    $pendaftaran->update($validatedData);

    return redirect()->route('formulir.show')->with('success', 'Data pendaftaran berhasil diperbarui!');
}

    
    public function tracking()
{
    $data = auth()->user()->pendaftaran;

    if (!$data) {
        return redirect()->route('formulir.create')->with('info', 'Silakan isi formulir terlebih dahulu.');
    }

    return view('pendaftaran.tracking', compact('data'));
    }
public function updateStatus(Request $request, $id)
{
    // Validasi input status
    $validated = $request->validate([
        'status' => 'required|in:menunggu,diterima,ditolak',
    ]);

    // Ambil data
    $pendaftaran = Pendaftaran::findOrFail($id);
    $status = $validated['status'];

    // Jika statusnya 'ditolak'
    if ($status === 'ditolak') {
        // Set status ke 'ditolak'
        $pendaftaran->status = 'ditolak';

        // Cek apakah gelombang yang digunakan adalah gelombang ketiga
        $gelombangs = Gelombang::where('is_active', 1)->orderBy('tanggal_mulai')->get();

        // Cek apakah sudah ada 3 gelombang aktif
        if ($gelombangs->count() >= 3) {
            $gelombangKetiga = $gelombangs->get(2); // Ambil gelombang ketiga (indeks ke-2)

            if ($pendaftaran->gelombang_id == $gelombangKetiga->id) {
                // Jika pendaftar ada di gelombang ketiga, set status pendaftaran menjadi 'ditolak'
                $pendaftaran->status = 'ditolak';
                $pendaftaran->save();

                return redirect()->back()->with('success', 'Pendaftaran Anda telah ditolak di gelombang ketiga.');
            }
        }

        // Cari gelombang berikutnya
        $gelombangBerikutnya = Gelombang::where('is_active', 1)
            ->where('id', '>', $pendaftaran->gelombang_id)
            ->first();

        if ($gelombangBerikutnya) {
            // Pindahkan ke gelombang berikutnya jika masih ada
            $pendaftaran->gelombang_id = $gelombangBerikutnya->id;
        } else {
            // Jika tidak ada gelombang aktif berikutnya, status tetap 'ditolak'
            $pendaftaran->status = 'ditolak';
        }
    } else {
        // Set status sesuai input
        $pendaftaran->status = $status;
    }

    $pendaftaran->save();

    return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
}



        public function updateGelombang(Request $request, $id)
        {
            $validated = $request->validate([
                'gelombang_id' => 'required|exists:gelombangs,id',
            ]);

            $pendaftaran = Pendaftaran::findOrFail($id);
            $pendaftaran->gelombang_id = $validated['gelombang_id'];
            $pendaftaran->save();

            return redirect()->back()->with('success', 'Gelombang berhasil diperbarui.');
    }



}

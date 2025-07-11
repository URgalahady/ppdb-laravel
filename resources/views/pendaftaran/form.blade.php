@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Formulir Pendaftaran PPDB</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('formulir.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Contoh: Bandung">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir">
                        </div>

                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control" id="asal_sekolah" placeholder="Contoh: SMPN 1 Cicalengka">
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Pas Foto</label>
                            <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="ijazah" class="form-label">Upload Ijazah</label>
                            <input type="file" name="ijazah" class="form-control" id="ijazah" accept=".pdf,image/*">
                        </div>

                        <div class="mb-3">
                            <label for="akta" class="form-label">Upload Akta Kelahiran</label>
                            <input type="file" name="akta" class="form-control" id="akta" accept=".pdf,image/*">
                        </div>
                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label">Pilih Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" class="form-select" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $pendaftaran->jurusan_id ?? '') == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Kirim Pendaftaran</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

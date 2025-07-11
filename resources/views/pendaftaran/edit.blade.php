@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded-lg">
                <div class="card-header bg-primary text-white rounded-top">
                    <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i> Edit Pendaftaran</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('formulir.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama Lengkap --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $pendaftaran->nama) }}" required autofocus>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Asal Sekolah --}}
                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <input id="asal_sekolah" type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" name="asal_sekolah" value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah) }}" required>
                            @error('asal_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jurusan Pilihan --}}
                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label">Jurusan Pilihan</label>
                            <select name="jurusan_id" id="jurusan_id" class="form-select @error('jurusan_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $pendaftaran->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pas Foto --}}
                        <div class="mb-3">
                            <label for="foto" class="form-label">Pas Foto</label>
                            <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                            @if($pendaftaran->foto)
                                <small class="form-text text-muted">Foto saat ini: <a href="{{ asset('storage/' . $pendaftaran->foto) }}" target="_blank">Lihat Foto</a></small><br>
                            @endif
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ijazah --}}
                        <div class="mb-3">
                            <label for="ijazah" class="form-label">Ijazah</label>
                            <input id="ijazah" type="file" class="form-control @error('ijazah') is-invalid @enderror" name="ijazah">
                            @if($pendaftaran->ijazah)
                                <small class="form-text text-muted">Ijazah saat ini: <a href="{{ asset('storage/' . $pendaftaran->ijazah) }}" target="_blank">Lihat Ijazah</a></small><br>
                            @endif
                            @error('ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Akta Kelahiran --}}
                        <div class="mb-3">
                            <label for="akta" class="form-label">Akta Kelahiran</label>
                            <input id="akta" type="file" class="form-control @error('akta') is-invalid @enderror" name="akta">
                            @if($pendaftaran->akta)
                                <small class="form-text text-muted">Akta saat ini: <a href="{{ asset('storage/' . $pendaftaran->akta) }}" target="_blank">Lihat Akta</a></small><br>
                            @endif
                            @error('akta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="d-flex justify-content-between mb-3">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Perbarui Data</button>
                            <a href="{{ route('formulir.show') }}" class="btn btn-secondary"><i class="fas fa-times me-2"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('formulir.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Hidden untuk Gelombang -->
                        <input type="hidden" name="gelombang_id" value="{{ $gelombangAktif->id }}">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                   id="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                            @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                   id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" 
                                   id="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
                            @error('asal_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Pas Foto (Max 2MB)</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" 
                                   id="foto" accept="image/*" required>
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ijazah" class="form-label">Upload Ijazah (PDF/Image, Max 2MB)</label>
                            <input type="file" name="ijazah" class="form-control @error('ijazah') is-invalid @enderror" 
                                   id="ijazah" accept=".pdf,image/*" required>
                            @error('ijazah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="akta" class="form-label">Upload Akta Kelahiran (PDF/Image, Max 2MB)</label>
                            <input type="file" name="akta" class="form-control @error('akta') is-invalid @enderror" 
                                   id="akta" accept=".pdf,image/*" required>
                            @error('akta')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label">Pilih Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" 
                                    class="form-select @error('jurusan_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" 
                                        {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                        (Kuota: {{ $jurusan->kuota }})
                                    </option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                       <div class="alert alert-info">
    <strong>Gelombang Pendaftaran:</strong> {{ $gelombangAktif->nama }}
    ({{ \Carbon\Carbon::parse($gelombangAktif->tanggal_mulai)->format('d/m/Y') }} - 
     {{ \Carbon\Carbon::parse($gelombangAktif->tanggal_berakhir)->format('d/m/Y') }})
</div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Pendaftaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
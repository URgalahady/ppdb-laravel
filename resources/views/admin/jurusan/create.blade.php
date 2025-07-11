@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Jurusan Baru</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.jurusan.store') }}" method="POST">
                        @csrf

                          <div class="mb-3">
                            <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                            <select name="nama_jurusan" class="form-select @error('nama_jurusan') is-invalid @enderror" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <option value="Rekayasa Perangkat Lunak" {{ old('nama_jurusan') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                <option value="Teknik Komputer Dan Jaringan" {{ old('nama_jurusan') == 'Teknik Komputer Dan Jaringan' ? 'selected' : '' }}>Teknik Komputer Dan Jaringan</option>
                                <option value="Perhotelan" {{ old('nama_jurusan') == 'Perhotelan' ? 'selected' : '' }}>Perhotelan</option>
                                <option value="Akuntansi" {{ old('nama_jurusan') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                            </select>
                            @error('nama_jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota Pendaftaran</label>
                            <input type="number" class="form-control @error('kuota') is-invalid @enderror"
                                   name="kuota" value="{{ old('kuota') }}" min="1" required>
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0">Edit Jurusan</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Jurusan -->
                        <div class="mb-4">
                            <label for="nama_jurusan" class="form-label fs-5">Nama Jurusan</label>
                            <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror"
                                   name="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}" required autofocus>
                            @error('nama_jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kuota Pendaftaran -->
                        <div class="mb-4">
                            <label for="kuota" class="form-label fs-5">Kuota Pendaftaran</label>
                            <input type="number" class="form-control @error('kuota') is-invalid @enderror"
                                   name="kuota" value="{{ old('kuota', $jurusan->kuota) }}" min="1" required>
                            @error('kuota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Submit dan Kembali -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.jurusan.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

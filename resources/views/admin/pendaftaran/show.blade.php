@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold">Detail Pendaftar</h3>

    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-secondary mb-4">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>

    <div class="card border-0 shadow rounded-3">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <!-- Profil Kiri -->
                <div class="col-md-4 text-center">
                    <img src="{{ asset('storage/' . $pendaftaran->foto) }}" class="img-fluid rounded-circle shadow mb-3" style="max-width: 150px;" alt="Pas Foto">
                    <h5 class="mt-2">{{ $pendaftaran->nama }}</h5>
                    <span class="badge bg-info text-dark">{{ $pendaftaran->jurusan->nama_jurusan ?? 'Belum memilih jurusan' }}</span>
                </div>

                <!-- Informasi Kanan -->
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Email</th>
                            <td>: {{ $pendaftaran->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>: {{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Asal Sekolah</th>
                            <td>: {{ $pendaftaran->asal_sekolah }}</td>
                        </tr>
                    </table>

                    <hr>

                    <div class="d-flex gap-3 flex-wrap">
                        <div>
                            <h6 class="mb-1">Ijazah</h6>
                            <a href="{{ asset('storage/' . $pendaftaran->ijazah) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-file-pdf me-1"></i> Lihat Ijazah
                            </a>
                        </div>
                        <div>
                            <h6 class="mb-1">Akta Kelahiran</h6>
                            <a href="{{ asset('storage/' . $pendaftaran->akta) }}" target="_blank" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-file-pdf me-1"></i> Lihat Akta
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light text-center">
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">
                <i class="fas fa-list me-1"></i> Kembali ke Daftar Pendaftar
            </a>
        </div>
    </div>
</div>
@endsection

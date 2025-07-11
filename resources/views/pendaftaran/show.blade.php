@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Bagian untuk Menampilkan Notifikasi --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Card untuk Menampilkan Profil Pendaftaran --}}
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i> Profil Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="col-4">Nama Lengkap</th>
                            <td>{{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>{{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan Pilihan</th>
                            <td>{{ $data->jurusan ? $data->jurusan->nama_jurusan : 'Belum dipilih' }}</td>
                        </tr>
                        <tr>
                            <th>Asal Sekolah</th>
                            <td>{{ $data->asal_sekolah }}</td>
                        </tr>
                        <tr>
                            <th>Pas Foto</th>
                            <td>
                                <img src="{{ asset('storage/' . $data->foto) }}" alt="Pas Foto" class="img-fluid rounded-circle shadow" width="150">
                            </td>
                        </tr>
                        <tr>
                            <th>Ijazah</th>
                            <td>
                                <a href="{{ asset('storage/' . $data->ijazah) }}" class="btn btn-outline-info btn-sm" target="_blank">
                                    <i class="fas fa-file-pdf me-2"></i> Lihat Ijazah
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Akta Kelahiran</th>
                            <td>
                                <a href="{{ asset('storage/' . $data->akta) }}" class="btn btn-outline-success btn-sm" target="_blank">
                                    <i class="fas fa-file-pdf me-2"></i> Lihat Akta
                                </a>
                            </td>
                        </tr>
                    </table>
                    <div class="alert alert-info">
                            Status Pendaftaran:
                            @if($data->status == 'diterima')
                                <span class="text-success fw-bold">Diterima</span>
                            @elseif($data->status == 'ditolak')
                                <span class="text-danger fw-bold">Ditolak</span>
                            @else
                                <span class="text-warning fw-bold">Menunggu Verifikasi</span>
                            @endif
                    </div>


                    <div class="d-flex justify-content-between mt-4">
                       @if($data->status !== 'diterima')
    <a href="{{ route('formulir.edit') }}" class="btn btn-warning">Edit Data</a>
@endif


                        <a href="{{ url('/') }}" class="btn btn-secondary">
                            <i class="fas fa-home me-2"></i> Kembali ke Homepage
                        </a>
                        <a href="{{ route('formulir.tracking') }}" class="btn btn-info">Lihat Progress</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

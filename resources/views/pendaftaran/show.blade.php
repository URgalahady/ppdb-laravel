@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-user-circle"></i> Profil Pendaftaran</h3>
        </div>
        
        <div class="card-body">
            @if($data)
            <div class="row">
                <!-- Kolom Foto -->
                <div class="col-md-4 text-center">
                    <img src="{{ asset('storage/' . $data->foto) }}" 
                         class="img-thumbnail mb-3" 
                         style="width: 200px; height: 250px; object-fit: cover;">
                    
                    <div class="status-box p-3 mb-3 
                        @if($data->status == 'diterima') bg-success
                        @elseif($data->status == 'ditolak') bg-danger
                        @else bg-warning @endif text-white">
                        <h5 class="mb-0">
                            Status: {{ ucfirst($data->status) }}
                        </h5>
                    </div>
                </div>

                <!-- Kolom Data -->
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama Lengkap</th>
                            <td>{{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <th>Tempat/Tanggal Lahir</th>
                            <td>
                                {{ $data->tempat_lahir }}, 
                                {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Asal Sekolah</th>
                            <td>{{ $data->asal_sekolah }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $data->jurusan->nama_jurusan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Gelombang</th>
                            <td>
                                {{ $data->gelombang->nama ?? '-' }} 
                                ({{ $data->gelombang->is_active ? 'Aktif' : 'Tidak Aktif' }})
                            </td>
                        </tr>
                    </table>

                    <!-- Dokumen Pendaftaran -->
                    <div class="mt-4">
                        <h5><i class="fas fa-file-alt"></i> Dokumen Pendaftaran:</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ asset('storage/' . $data->ijazah) }}" target="_blank">
                                    <i class="fas fa-file-pdf"></i> Ijazah
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ asset('storage/' . $data->akta) }}" target="_blank">
                                    <i class="fas fa-file-pdf"></i> Akta Kelahiran
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                Data pendaftaran tidak ditemukan. Silakan isi formulir terlebih dahulu.
            </div>
            @endif
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('formulir.edit') }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Data
            </a>
        </div>
    </div>
</div>
@endsection
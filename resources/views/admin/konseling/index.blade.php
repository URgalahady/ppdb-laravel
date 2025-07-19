@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h3 class="fw-bold mb-4">Daftar Pengajuan Konseling</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Jenis Konseling</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($konselings as $konseling)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $konseling->user->name }}</td>
                    <td>{{ ucfirst($konseling->jenis) }}</td>
                    <td>
                        <span class="badge 
                            @if($konseling->status == 'menunggu') bg-warning text-dark
                            @elseif($konseling->status == 'diproses') bg-info text-dark
                            @elseif($konseling->status == 'selesai') bg-success
                            @else bg-secondary
                            @endif">
                            {{ ucfirst($konseling->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.konseling.show', $konseling->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3>Daftar Jurusan</h3>

    <!-- Tombol kembali ke dashboard -->
    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary mb-3 me-2">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
    </a>

    <!-- Tombol tambah jurusan -->
    <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary mb-3">
        + Tambah Jurusan
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jurusan</th>
                <th>Kuota</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurusans as $jurusan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jurusan->nama_jurusan }}</td>
                    <td>{{ $jurusan->kuota }}</td>
                    <td>
                        @if($jurusan->penuh)
                            <span class="badge bg-danger">Penuh</span>
                        @else
                            <span class="badge bg-success">Tersedia</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.jurusan.edit', $jurusan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus jurusan ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

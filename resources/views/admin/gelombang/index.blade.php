@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Gelombang</h3>
        <a href="{{ route('admin.gelombang.create') }}" class="btn btn-primary float-end">
            <i class="fas fa-plus"></i> Tambah Gelombang
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gelombangs as $gelombang)
                <tr>
                    <td>{{ $gelombang->nama }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($gelombang->tanggal_mulai)->format('d M Y') }} - 
                        {{ \Carbon\Carbon::parse($gelombang->tanggal_berakhir)->format('d M Y') }}
                    </td>
                    <td>
                        <span class="btn btn-sm {{ $gelombang->is_active ? 'btn-success' : 'btn-secondary' }}">
                            {{ $gelombang->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.gelombang.edit', $gelombang->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.gelombang.destroy', $gelombang->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus gelombang ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

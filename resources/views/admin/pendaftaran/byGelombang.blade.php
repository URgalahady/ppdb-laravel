@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3>📌 Data Pendaftar Berdasarkan Gelombang</h3>

    @foreach ($gelombangs as $gel)
        <h5 class="mt-4">{{ $gel->nama }} ({{ $gel->is_active ? 'Aktif' : 'Tidak Aktif' }})</h5>

        @if($gel->pendaftaran->count() > 0)
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Asal Sekolah</th>
                    <th>Jurusan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gel->pendaftaran as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->user->email ?? '-' }}</td>
                        <td>{{ $item->asal_sekolah }}</td>
                        <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                        <td>
                            <span class="badge 
                                @if($item->status == 'menunggu') bg-warning 
                                @elseif($item->status == 'diterima') bg-success 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-muted">Belum ada pendaftar di gelombang ini.</p>
        @endif
    @endforeach
</div>
@endsection

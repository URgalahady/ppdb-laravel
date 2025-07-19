@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Riwayat Konseling Anda</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Konseling</th>
                <th>Status</th>
                <th>Tanggapan</th>
                <th>Waktu Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($konselings as $konseling)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
                    <td>{{ $konseling->tanggapan ?? 'Belum ada tanggapan' }}</td>
                    <td>{{ $konseling->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada pengajuan konseling.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

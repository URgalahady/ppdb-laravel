@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3>📌 Data Pendaftar Berdasarkan Status</h3>

    {{-- MENUNGGU --}}
    <h5 class="mt-4">🕓 Menunggu</h5>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Gelombang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menunggu as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->user->email ?? '-' }}</td>
                    <td>{{ $item->asal_sekolah }}</td>
                    <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                    <td>{{ $item->gelombang->nama ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- DITERIMA --}}
    <h5 class="mt-5">✅ Diterima</h5>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Gelombang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diterima as $item)
                                <td>{{ $item->nama }}</td>
                    <td>{{ $item->user->email ?? '-' }}</td>
                    <td>{{ $item->asal_sekolah }}</td>
                    <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                    <td>{{ $item->gelombang->nama ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- DITOLAK --}}
    <h5 class="mt-5">❌ Ditolak</h5>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Gelombang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ditolak as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->user->email ?? '-' }}</td>
                    <td>{{ $item->asal_sekolah }}</td>
                    <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
                    <td>{{ $item->gelombang->nama ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

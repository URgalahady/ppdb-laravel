@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h3 class="fw-bold mb-4">📨 Pesan Masuk dari Siswa</h3>

    @if ($kontaks->count() == 0)
        <div class="alert alert-info">Belum ada pesan masuk.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Subjek</th>
                    <th>Pesan</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kontaks as $kontak)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kontak->nama }}</td>
                        <td>{{ $kontak->subjek }}</td>
                        <td>{{ $kontak->pesan }}</td>
                        <td>{{ $kontak->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

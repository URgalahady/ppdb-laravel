@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h3 class="fw-bold mb-4">Pesan dari Siswa</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Subjek</th>
                <th>Pesan</th>
                <th>Tanggal</th>
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
</div>
@endsection

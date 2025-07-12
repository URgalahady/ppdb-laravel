@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Gelombang</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.gelombang.update', $gelombang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Gelombang</label>
                <input type="text" class="form-control" id="nama" name="nama" 
                       value="{{ $gelombang->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                        {{ \Carbon\Carbon::parse($gelombang->tanggal_mulai)->format('d M Y') }} - >
            </div>
            <div class="mb-3">
                <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" 
                       {{ \Carbon\Carbon::parse($gelombang->tanggal_berakhir)->format('d M Y') }}>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.gelombang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
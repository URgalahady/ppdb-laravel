@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Tambah Gelombang Baru</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.gelombang.store') }}" method="POST">
            @csrf
                <div class="mb-3">
                <label for="nama" class="form-label">Pilih Gelombang</label>
                <select class="form-control" id="nama" name="nama" required>
                    <option value="">-- Pilih Gelombang --</option>
                    <option value="Gelombang 1">Gelombang 1</option>
                    <option value="Gelombang 2">Gelombang 2</option>
                    <option value="Gelombang 3">Gelombang 3</option>
                    <option value="Gelombang 4">Gelombang 4</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.gelombang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
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
                <label for="nama" class="form-label">Pilih Nama Gelombang</label>
                <select name="nama" class="form-control" id="nama" required>
                    <option value="Gelombang 1" {{ $gelombang->nama == 'Gelombang 1' ? 'selected' : '' }}>Gelombang 1</option>
                    <option value="Gelombang 2" {{ $gelombang->nama == 'Gelombang 2' ? 'selected' : '' }}>Gelombang 2</option>
                    <option value="Gelombang 3" {{ $gelombang->nama == 'Gelombang 3' ? 'selected' : '' }}>Gelombang 3</option>
                    <option value="Gelombang 4" {{ $gelombang->nama == 'Gelombang 4' ? 'selected' : '' }}>Gelombang 4</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $gelombang->tanggal_mulai }}">
            </div>

            <div class="mb-3">
                <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" value="{{ $gelombang->tanggal_berakhir }}">
            </div>

            <div class="mb-3">
                <select name="is_active" class="form-control" id="">
                    <option value="1" {{ $gelombang->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $gelombang->is_active == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.gelombang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

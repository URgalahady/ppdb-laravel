@extends('layouts.admin')

@section('content')
    <h4>Detail Pengajuan Konseling</h4>
    
    <div class="card">
        <div class="card-body">
            <h5>Nama Siswa: {{ $konseling->user->name }}</h5>
            <p>Jenis: {{ $konseling->jenis }}</p>
            <p>Pesan: {{ $konseling->pesan }}</p>

            <!-- Form untuk mengupdate status dan tanggapan -->
            <form action="{{ route('admin.konseling.update', $konseling->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="menunggu" {{ $konseling->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ $konseling->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $konseling->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggapan" class="form-label">Tanggapan</label>
                    <textarea name="tanggapan" id="tanggapan" class="form-control" rows="4">{{ old('tanggapan', $konseling->tanggapan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
@endsection

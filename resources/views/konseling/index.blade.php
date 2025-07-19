@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Ajukan Konseling</h3>

    <form action="{{ route('konseling.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Konseling</label>
            <select name="jenis" id="jenis" class="form-select" required>
                <option value="">-- Pilih Jenis Konseling --</option>
                <option value="pribadi">Pribadi</option>
                <option value="akademik">Akademik</option>
                <option value="karier">Karier</option>
                <option value="sosial">Sosial</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pesan" class="form-label">Tulis Permintaan Konseling</label>
            <textarea name="pesan" id="pesan" class="form-control" rows="5" placeholder="Tulis masalah atau pertanyaan Anda..." required></textarea>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Ajukan Konseling</button>
            <a href="{{ route('konseling.riwayat') }}" class="btn btn-secondary">Lihat Riwayat Konseling</a>
        </div>
    </form>

    <div class="mt-4">
        <a href="{{ route('home') }}" class="btn btn-link text-decoration-none">Kembali ke Beranda</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection

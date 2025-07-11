@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h3 class="text-center mb-4">Informasi Pendaftaran</h3>

    <div class="mb-3">
        <strong>Tanggal Pendaftaran:</strong> {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d M Y') }}<br>
        <strong>Nomor Pendaftaran:</strong> {{ $data->id }}
    </div>

    @php
        $urutan = ['administrasi', 'penilaian', 'wawancara', 'selesai'];
        $label = [
            'administrasi' => 'Tahap Administrasi',
            'penilaian' => 'Test Potensi Akademik',
            'wawancara' => 'Wawancara',
            'selesai' => 'Penetapan'
        ];
    @endphp

    <div class="d-flex flex-wrap gap-3 justify-content-between">
        @foreach($urutan as $step)
            <div class="text-center p-3 rounded"
                style="flex: 1; min-width: 200px;
                background-color: {{ array_search($step, $urutan) <= array_search($data->tahap, $urutan) ? '#d4f8d4' : '#f0f0f0' }};
                border: 1px solid #ccc;">
                <strong>{{ $label[$step] }}</strong><br>
                <span style="color: {{ array_search($step, $urutan) <= array_search($data->tahap, $urutan) ? 'green' : '#999' }}">
                    {{ array_search($step, $urutan) <= array_search($data->tahap, $urutan) ? '✓ Selesai' : '⏳ Menunggu' }}
                </span>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <strong>Prodi Pilihan 1:</strong> {{ $data->jurusan->nama ?? '-' }}<br>
        <strong>Prodi Pilihan 2:</strong> {{ $data->pilihan_kedua ?? '-' }}
    </div>
    <a href="{{ route('formulir.show') }}" class="btn btn-secondary">
                            <i class="fas fa-home me-2"></i> Kembali Ke Profile
                        </a>
</div>
@endsection

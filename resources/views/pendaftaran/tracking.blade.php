@extends('layouts.app') {{-- Pastikan ini mengarah ke layout utama Anda --}}

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold">INFORMASI PENDAFTARAN</h3>
        {{-- Deskripsi tambahan bisa ditambahkan di sini jika diperlukan --}}
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-3 mb-4 justify-content-center"> {{-- Menggunakan g-3 untuk gap, row-cols-md-4 untuk 4 kolom di layar medium ke atas --}}
        @php
            // Definisi tahapan sesuai urutan dan label
            $steps = [
                'administrasi' => 'Tahap Administrasi',
                'tes_akademik' => 'Test Potensi Akademik',
                'wawancara' => 'Wawancara',
                'selesai' => 'Penetapan'
            ];

            // Tahap aktif dari data pendaftaran Anda
            $activeStep = $data->tahap ?? 'administrasi'; // Default ke 'administrasi' jika belum ada tahap

            // Urutan kunci tahap untuk perbandingan
            $stepKeys = array_keys($steps);
            $activeIndex = array_search($activeStep, $stepKeys);
        @endphp

        @foreach($stepKeys as $index => $key)
            @php
                $label = $steps[$key];
                $cardClass = 'bg-light text-dark'; // Default: ringan, teks gelap
                $statusIcon = 'fa-circle text-muted'; // Default: ikon lingkaran abu-abu
                $statusText = 'Belum';

                if ($index < $activeIndex) {
                    // Tahap yang sudah selesai
                    $cardClass = 'bg-success text-white';
                    $statusIcon = 'fa-check-circle';
                    $statusText = 'Selesai';
                } elseif ($index == $activeIndex) {
                    // Tahap yang sedang aktif
                    if ($key == 'penetapan') {
                        $cardClass = 'bg-light'; // Latar putih untuk tahap penetapan
                        $statusIcon = 'fa-clock text-muted'; // Ikon jam
                        $statusText = 'Menunggu';
                    } else {
                        $cardClass = 'bg-success text-white'; // Hijau cerah untuk tahap aktif lainnya
                        $statusIcon = 'fa-check-circle'; // Ikon centang
                        $statusText = 'Selesai';
                    }
                }
            @endphp

            <div class="col">
                <div class="card h-100 {{ $cardClass }} border-0 shadow-sm rounded">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title mb-2">{{ $label }}</h5>
                        <p class="card-text mb-2">
                            <i class="fas {{ $statusIcon }} fa-2x"></i> {{-- Ikon lebih besar untuk visual --}}
                        </p>
                        <span class="small fw-bold">{{ $statusText }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('formulir.show') }}" class="btn btn-info me-2">Lihat Data Pendaftaran</a>
        <a href="{{ route('profile') }}" class="btn btn-secondary">Kembali ke Profil</a>
    </div>
</div>
@endsection

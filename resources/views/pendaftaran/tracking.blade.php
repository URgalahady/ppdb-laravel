@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h3 class="fw-bold">INFORMASI PENDAFTARAN</h3>
    </div>

    @php
        // Tahapan dan labelnya
        $steps = [
            'administrasi' => 'Tahap Administrasi',
            'tes_akademik' => 'Test Potensi Akademik',
            'wawancara' => 'Wawancara',
            'selesai' => 'Penetapan'
        ];

        $activeStep = $data->tahap ?? 'administrasi'; // tahap aktif
        $stepKeys = array_keys($steps);
        $activeIndex = array_search($activeStep, $stepKeys);
    @endphp

    <div class="row justify-content-center">
        <div class="col-md-6">
            @foreach($stepKeys as $index => $key)
                @php
                    $label = $steps[$key];
                    $cardClass = 'bg-light text-dark'; // default
                    $statusIcon = 'fa-circle text-muted';
                    $statusText = 'Belum';

                    if ($index < $activeIndex) {
                        $cardClass = 'bg-success text-white';
                        $statusIcon = 'fa-check-circle';
                        $statusText = 'Selesai';
                    } elseif ($index == $activeIndex) {
                        if ($key == 'selesai') {
                            $cardClass = 'bg-light';
                            $statusIcon = 'fa-clock text-muted';
                            $statusText = 'Menunggu';
                        } else {
                            $cardClass = 'bg-success text-white';
                            $statusIcon = 'fa-check-circle';
                            $statusText = 'Selesai';
                        }
                    }
                @endphp

                <div class="card mb-3 {{ $cardClass }} shadow-sm border-0 rounded">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">{{ $label }}</h5>
                        <p class="mb-2">
                            <i class="fas {{ $statusIcon }} fa-2x"></i>
                        </p>
                        <div class="small fw-bold">{{ $statusText }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('formulir.show') }}" class="btn btn-info me-2">Lihat Data Pendaftaran</a>
        <a href="{{ route('profile') }}" class="btn btn-secondary">Kembali ke Profil</a>
    </div>
</div>
@endsection

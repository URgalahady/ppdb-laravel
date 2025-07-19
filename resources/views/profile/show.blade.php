@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📋 Profil Pendaftaran</h4>
                </div>

                <div class="card-body">
                    @guest
                        <div class="alert alert-info">
                            Silakan login untuk melihat status pendaftaran.
                        </div>
                    @else
                        @php
                            $user = Auth::user();
                            $pendaftaran = $user->pendaftaran;
                        @endphp

                        {{-- Status Pendaftaran --}}
                        @if($pendaftaran)
                            @if($pendaftaran->status === 'diterima')
                                <div class="alert alert-success">
                                    🎉 Selamat! Kamu <strong>DITERIMA</strong> di 
                                    <strong>{{ $pendaftaran->jurusan->nama_jurusan ?? 'Jurusan Belum Ditentukan' }}</strong>.
                                </div>
                            @elseif($pendaftaran->status === 'ditolak')
                                <div class="alert alert-danger">
                                    😢 Maaf, kamu <strong>DITOLAK</strong>. Silakan hubungi pihak sekolah untuk info lebih lanjut.
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    ⏳ Pendaftaranmu sedang <strong>MENUNGGU</strong> verifikasi.
                                </div>
                            @endif
                        @else
                            <div class="alert alert-info">
                                Kamu <strong>belum mendaftar</strong>. Silakan isi formulir pendaftaran terlebih dahulu.
                            </div>
                        @endif

                        {{-- Informasi User --}}
                        <div class="mt-4">
                            <div class="mb-3">
                                <strong>Nama:</strong>
                                <p class="lead mb-0">{{ $user->name }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong>
                                <p class="lead mb-0">{{ $user->email }}</p>
                            </div>
                            @if($pendaftaran)
                                <div class="mb-3">
                                    <strong>Asal Sekolah:</strong>
                                    <p class="lead mb-0">{{ $pendaftaran->asal_sekolah }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong>Jurusan Dipilih:</strong>
                                    <p class="lead mb-0">{{ $pendaftaran->jurusan->nama_jurusan ?? '-' }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong>Status Pendaftaran:</strong>
                                    <p class="lead mb-0 text-capitalize">{{ $pendaftaran->status }}</p>
                                </div>
                            @endif
                        </div>
                    @endguest
                </div>

                {{-- Ajakan Daftar / Tracking --}}
                <div class="card-footer bg-primary text-white text-center">
                    @auth
                        @if ($user->pendaftaran)
                            <h5 class="fw-bold mb-2">📋 Pendaftaran Anda Sedang Diproses</h5>
                            <a href="{{ route('formulir.tracking') }}" class="btn btn-light fw-semibold shadow-sm">
                                Lihat Status Pendaftaran
                            </a>
                        @else
                            <h5 class="fw-bold mb-2">📢 Siap Bergabung?</h5>
                            <p class="mb-3">Isi formulir dan jadi bagian dari sekolah impianmu!</p>
                            <a href="{{ route('formulir.create') }}" class="btn btn-light fw-semibold shadow-sm">
                                Isi Formulir Sekarang <i class="fa-solid fa-arrow-right-long ms-1"></i>
                            </a>
                        @endif
                    @else
                        <h5 class="fw-bold mb-2">📢 Siap Bergabung?</h5>
                        <p class="mb-3">Ayo, daftar sekarang dan wujudkan cita-citamu!</p>
                        <a href="{{ route('register') }}" class="btn btn-light fw-semibold shadow-sm">
                            Daftar Sekarang <i class="fa-solid fa-arrow-right-long ms-1"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

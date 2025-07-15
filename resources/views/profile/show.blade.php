@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Data Pribadi</h4>
                </div>
                <div class="card-body">
                    {{-- Informasi User --}}
                    <div class="mb-3">
                        <strong>Nama:</strong>
                        <p class="lead mb-0">{{ $user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p class="lead mb-0">{{ $user->email }}</p>
                    </div>

                    {{-- Status Pendaftaran --}}
                    <div class="rounded p-4 mt-4 text-center bg-primary text-white">
                        @auth
                            @if (auth()->user()->pendaftaran)
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
</div>
@endsection

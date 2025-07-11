@extends('layouts.logreg')

@section('content')
<div class="container-fluid py-4 login-container-wrapper"> {{-- Tambahkan kelas baru: login-container-wrapper --}}
    <div class="row justify-content-center align-items-center min-vh-100"> {{-- min-vh-100 untuk tinggi penuh viewport --}}
        <div class="col-md-5">
            <div class="row shadow-lg border-0 rounded-4 overflow-hidden">
                
                <div class="col-md-6 text-white p-4 d-flex flex-column justify-content-center position-relative" style="
                    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                    url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
                    background-size: cover;
                    background-position: center;
                    min-height: 100%;
                ">
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/smk.png') }}" alt="Logo SMK" width="100" class="img-fluid">
                    </div>
                    <h2 class="text-center mb-3 fw-bold" style="color: #00a2ff;">Selamat Datang Kembali</h2>
                    <p class="text-center mb-4">Masuk untuk melanjutkan proses PPDB SMKN 1 Manokwari</p>
                    
                    <ul class="list-unstyled ps-4">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 text-success"></i>
                            <span>Akses data pendaftaran</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 text-success"></i>
                            <span>Upload dokumen persyaratan</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 text-success"></i>
                            <span>Pantau status pendaftaran</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 text-success"></i>
                            <span>Notifikasi real-time & email</span>
                        </li>
                    </ul>
                    
                    <div class="mt-4 text-center">
                        <div class="d-inline-block p-2 bg-white rounded-circle">
                            <i class="fas fa-graduation-cap text-success fs-3"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 bg-white p-4">
                    <h3 class="text-center mb-4">Masuk ke Akun</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i> Masuk
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <small>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></small>
                        </div>
                        <div class="text-center mt-2">
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-home me-2"></i> Kembali ke Halaman Utama
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

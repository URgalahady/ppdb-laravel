@extends('layouts.logreg')

@section('content')
<div class="container-fluid py-4 login-container-wrapper">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="row shadow-lg border-0 rounded-4 overflow-hidden">
                <!-- Kolom Form Register -->
                <div class="col-md-6 bg-white p-4">
                    <h3 class="text-center mb-4">Daftar Akun Baru</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user text-primary"></i>
                                </span>
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                            @error('name')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required>
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

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-user-plus me-2"></i> Daftar
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <small>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></small>
                        </div>
                        <div class="text-center mt-2">
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-home me-2"></i> Kembali ke Halaman Utama
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Kolom Deskripsi -->
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
                   <h2 class="text-center mb-3 fw-bold" style="color: #00a2ff;">Gabung di PPDB SMKN 1 MANOKWARI</h2>
                    <p class="text-center mb-4">Proses pendaftaran online kami sangat mudah dan efisien</p>
                    
                    <ul class="list-unstyled ps-4">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 text-success"></i>
                            <span>Proses cepat dan online</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 text-success"></i>
                            <span>Cek status pendaftaran kapan saja</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 text-success"></i>
                            <span>Upload dokumen secara langsung</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 text-success"></i>
                            <span>Dapatkan notifikasi real-time</span>
                        </li>
                    </ul>
                    
                    <div class="mt-4 text-center">
                        <div class="d-inline-block p-2 bg-white rounded-circle">
                            <i class="fas fa-graduation-cap text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
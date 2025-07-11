@extends('layouts.app')

@section('content')

<section class="hero-section hero-1 fix">
 <div class="container">
    <div class="row g-4 align-items-center">
        <div class="col-lg-6 order-lg-first order-2">
            <div class="hero-image wow fadeInUp" data-wow-delay=".4s">
                <img src="{{ asset('img/school.png') }}" class="img-fluid rounded" alt="Gedung Sekolah">
            </div>
        </div>

        <div class="col-lg-6 order-lg-last order-1">
            <div class="hero-content text-lg-start text-center">
                <h5 class="wow fadeInUp">Tentang SMKN 1 MANOKWARI</h5>
                <h1 class="wow fadeInUp" data-wow-delay=".3s">
                    Sekolah Unggulan di Papua Barat<br><span>Berbasis Teknologi & Prestasi</span>
                </h1>
                <p class="wow fadeInUp" data-wow-delay=".5s">
                    Menjadi pusat keunggulan dalam pendidikan kejuruan dengan dukungan teknologi, karakter, dan prestasi global.
                </p>
            </div>
        </div>
    </div>
</div>

</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="wow fadeInUp">Visi & Misi</h2>
        </div>

        <div class="row">
            <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <h4>Visi</h4>
                <p>“Menjadi SMK Unggulan Berbasis Teknologi dan Berkarakter.”</p>
            </div>
            <div class="col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <h4>Misi</h4>
                <ul>
                    <li>Menyelenggarakan pendidikan berbasis industri dan teknologi.</li>
                    <li>Mengembangkan karakter dan soft skill peserta didik.</li>
                    <li>Mewujudkan lulusan yang siap kerja, kuliah, dan berwirausaha.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="wow fadeInUp">Sejarah Singkat</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10 text-center wow fadeInUp" data-wow-delay=".3s">
                <p>SMKN 1 Manokwari didirikan pada tahun 1990 dan telah berkembang menjadi sekolah kejuruan terkemuka di Papua Barat. Dengan berbagai jurusan unggulan seperti Rekayasa Perangkat Lunak, Teknik Otomotif, dan Akuntansi, sekolah ini telah melahirkan lulusan-lulusan berprestasi yang berkontribusi di berbagai sektor nasional maupun internasional.</p>
            </div>
        </div>
    </div>
</section>

---

<section class="program-section section-padding section-bg-2 fix">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="wow fadeInUp">Ekstrakurikuler & Jurusan SMK</h2>
            <p class="wow fadeInUp" data-wow-delay=".2s">Mendukung bakat dan minat siswa melalui jurusan unggulan dan kegiatan ekstrakurikuler inspiratif</p>
        </div>

        <div class="row">
            {{-- RPL --}}
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="program-box-items text-center">
                    <div class="program-icon mb-3">
                        <i class="fas fa-laptop-code fa-4x text-info"></i> {{-- Ikon untuk RPL --}}
                    </div>
                    <div class="program-content">
                        <h4>Rekayasa Perangkat Lunak</h4>
                        <p class="text-dark">Belajar membuat aplikasi web, mobile, dan software.</p>
                    </div>
                </div>
            </div>

            {{-- TKJ --}}
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="program-box-items text-center">
                    <div class="program-icon mb-3">
                        <i class="fas fa-network-wired fa-4x text-primary"></i> {{-- Ikon untuk TKJ --}}
                    </div>
                    <div class="program-content">
                        <h4>Teknik Komputer & Jaringan</h4>
                        <p class="text-dark">Belajar jaringan komputer, server, dan perangkat keras.</p>
                    </div>
                </div>
            </div>

            {{-- Akuntansi --}}
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="program-box-items text-center">
                    <div class="program-icon mb-3">
                        <i class="fas fa-calculator fa-4x text-success"></i> {{-- Ikon untuk Akuntansi --}}
                    </div>
                    <div class="program-content">
                        <h4>Akuntansi & Keuangan</h4>
                        <p class="text-dark">Belajar pencatatan keuangan, akuntansi bisnis, dan perpajakan.</p>
                    </div>
                </div>
            </div>

            {{-- Perhotelan --}}
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                <div class="program-box-items text-center">
                    <div class="program-icon mb-3">
                        <i class="fas fa-hotel fa-4x text-warning"></i> {{-- Ikon untuk Perhotelan --}}
                    </div>
                    <div class="program-content">
                        <h4>Perhotelan</h4>
                        <p class="text-dark">Belajar hospitality, pelayanan tamu, dan tata boga dasar.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            {{-- Ekstrakurikuler: Pramuka --}}
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="program-box-items text-center">
                    <div class="program-image">
                        <img src="{{ asset('img/pramuka.jpg') }}" alt="Pramuka" class="img-fluid rounded mb-3">
                    </div>
                    <div class="program-content">
                        <h4>Pramuka</h4>
                        <p class="text-dark">Melatih jiwa kepemimpinan dan kedisiplinan siswa.</p>
                    </div>
                </div>
            </div>

            {{-- Ekstrakurikuler: Robotik --}}
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                <div class="program-box-items text-center">
                    <div class="program-image">
                        <img src="{{ asset('img/iot2.jpg') }}" alt="Robotik" class="img-fluid rounded mb-3">
                    </div>
                    <div class="program-content">
                        <h4>Robotik</h4>
                        <p class="text-dark">Berinovasi dan bersaing dalam teknologi robot modern.</p>
                    </div>
                </div>
            </div>

            {{-- Ekstrakurikuler: Basket --}}
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="program-box-items text-center">
                    <div class="program-image">
                        <img src="{{ asset('img/basket.jpg') }}" alt="Basket" class="img-fluid rounded mb-3">
                    </div>
                    <div class="program-content">
                        <h4>Basket</h4>
                        <p class="text-dark">Olahraga prestasi yang membangun kerjasama tim.</p>
                    </div>
                </div>
            </div>

            {{-- Ekstrakurikuler: English Club --}}
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                <div class="program-box-items text-center">
                    <div class="program-image">
                        <img src="{{ asset('img/kelas.jpg') }}" alt="English Club" class="img-fluid rounded mb-3">
                    </div>
                    <div class="program-content">
                        <h4>English Club</h4>
                        <p class="text-dark">Meningkatkan kemampuan bahasa Inggris secara aktif.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

---



@endsection
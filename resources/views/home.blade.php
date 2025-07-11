@extends('layouts.app')

@section('content')


<section class="hero-section hero-1 fix">
    
<div class="container py-4">
    <h1 class="mb-4">Selamat Datang di PPDB SMKN 1 Manokwari</h1>

    @guest
        <div class="alert alert-info">
            <p>📄 Kamu belum login untuk melihat status pendaftaranmu silahkan daftar atau login untuk mengetahui informasi
</p>
        </div>
    @else
        @php
            $pendaftaran = Auth::user()->pendaftaran;
        @endphp

        @if($pendaftaran)
            <!-- Tampilkan status penerimaan -->
            @if($pendaftaran->status === 'diterima')
                <div class="alert alert-success">
                    🎉 Selamat! Kamu <strong>DITERIMA</strong> di 
                    @if($pendaftaran->jurusan)
                        {{ $pendaftaran->jurusan->nama_jurusan }}
                    @else
                        <span>Jurusan Belum Ditentukan</span>
                    @endif
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
            
        @endif
    @endguest
</div>

    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h5 class="wow fadeInUp">PPDB SMKN 1 MANOKWARI</h5>
                    
                    <h1 class="wow fadeInUp" data-wow-delay=".3s">
                        Penerimaan Peserta Didik Baru<br> <span>2025/2026</span>
                        
                    </h1>
                    
                    <p class="wow fadeInUp" data-wow-delay=".5s">Mudah, cepat, dan efisien dalam pendaftaran online.</p>

                    @auth
                        <p class="wow fadeInUp" data-wow-delay=".5s">Halo, {{ Auth::user()->name }}! Selamat datang di portal PPDB Online.</p>

                        @if (Auth::user()->pendaftaran)
                            <a href="{{ route('formulir.show') }}" class="theme-btn wow fadeInUp" data-wow-delay=".7s">
                                Lihat Profil Pendaftaran <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        @else
                            <a href="{{ route('formulir.create') }}" class="theme-btn wow fadeInUp" data-wow-delay=".7s">
                                Isi Formulir Pendaftaran <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="theme-btn wow fadeInUp" data-wow-delay=".7s">
                            Masuk untuk Mendaftar <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image wow fadeInUp" data-wow-delay=".4s">
                    <img src="{{ asset('img/school.png') }}" class="img-fluid rounded" alt="Hero Image">
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Ekstrakurikuler -->
<!-- Ekstrakurikuler Section - Menggunakan komponen program dari template -->
<section class="program-section section-padding section-bg-2 fix">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="wow fadeInUp">Ekstrakurikuler Unggulan</h2>
        </div>
        
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="program-box-items">
                    <div class="program-bg"></div>
                    <div class="program-image"> 
                        <img src="{{ asset('img/robotik1.jpeg') }}" alt="Robotik" style="width: 100%; height: 400px; object-fit: cover;">
                    </div>
                    <div class="program-content text-center">
                        <h4>Robotic</h4>
                        <span>Robotic</span>
                        <p>Program robotika unggulan sekolah dengan prestasi gemilang yang menjadikan SMKN Manokwari 
                            Sebagai SMK unggulan Se-Indonesia dan menjadikannya top 10 SMK Dengan minat murid baru paling banyak di jawa barat</p>
                        <a href="#" class="arrow-icon">
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="program-box-items">
                    <div class="program-bg bg-1"></div>
                    
                    <div class="program-image">
                        <img src="{{ asset('img/baskett.jpeg') }}" alt="basket" style="width: 100%; height: 400px; object-fit: cover;">
                    </div>
                    <div class="program-content text-center">
                        <h4>Basket</h4>
                        <span>Olahraga</span>
                        <p>Tim basket sekolah dengan berbagai prestasi nasional dan internasional dan tim basket dari 
                            SMKN Manokwari telah menjuarai 4x juara Se-indonesia dan 2x Untuk internasional yang menjadikannya eskul unggulan</p>
                       <a href="#" class="arrow-icon">
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Section - Menggunakan komponen work process dari template -->
<section class="work-process-section fix section-padding">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="wow fadeInUp">Fasilitas Unggulan Sekolah Kami</h2>
            <p class="wow fadeInUp" data-wow-delay=".2s">Mendukung setiap aspek pembelajaran dan pengembangan potensi siswa</p>
        </div>
        
        <div class="process-work-wrapper">
            <div class="row g-4">
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="work-process-items text-center">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-laptop-code"></i> </div>
                        <div class="content">
                            <h4>Laboratorium Komputer Modern</h4>
                            <p>Dilengkapi PC canggih dan software terbaru untuk pemrograman, desain grafis, dan pengembangan teknologi informasi.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="work-process-items text-center style-2">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-globe"></i> </div>
                        <div class="content">
                            <h4>Perpustakaan Interaktif & Digital</h4>
                            <p>Koleksi buku fisik dan akses tak terbatas ke ribuan e-book, jurnal, serta database ilmiah global secara online.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="work-process-items text-center">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-cogs"></i> </div>
                        <div class="content">
                            <h4>Workshop Rekayasa & Teknik</h4>
                            <p>Area praktik lengkap dengan peralatan mutakhir untuk eksperimen fisika, robotika, otomotif, dan elektronika.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="work-process-items text-center style-2">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-language"></i>
                        </div>
                        <div class="content">
                            <h4>Laboratorium Bahasa Multimedia</h4>
                            <p>Fasilitas modern untuk meningkatkan kemampuan berbahasa asing melalui simulasi percakapan dan perangkat interaktif.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="work-process-items text-center">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <div class="content">
                            <h4>Studio Seni & Desain</h4>
                            <p>Lingkungan inspiratif dengan peralatan lengkap untuk seni rupa, desain grafis, fotografi, dan kerajinan tangan.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="work-process-items text-center style-2">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-futbol"></i>
                        </div>
                        <div class="content">
                            <h4>Arena Olahraga Outdoor & Indoor</h4>
                            <p>Lapangan basket, futsal, voli, serta gelanggang indoor untuk mendukung aktivitas fisik dan kompetisi olahraga.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="work-process-items text-center">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-microphone-alt"></i>
                        </div>
                        <div class="content">
                            <h4>Auditorium & Aula Serbaguna</h4>
                            <p>Ruang representatif untuk acara sekolah, pertunjukan seni, seminar, dan pertemuan besar dengan tata suara modern.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="work-process-items text-center style-2">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-medkit"></i>
                        </div>
                        <div class="content">
                            <h4>Pusat Layanan Kesehatan (UKS)</h4>
                            <p>Dilayani oleh tenaga medis profesional untuk penanganan pertolongan pertama dan konsultasi kesehatan siswa.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="work-process-items text-center">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="content">
                            <h4>Kantin & Area Bersantai</h4>
                            <p>Menyediakan hidangan bergizi, higienis, serta tempat nyaman untuk berinteraksi dan melepas penat siswa.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="work-process-items text-center style-2">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-parking"></i>
                        </div>
                        <div class="content">
                            <h4>Area Parkir Aman & Luas</h4>
                            <p>Fasilitas parkir yang tertata rapi dan aman untuk kendaraan roda dua maupun roda empat siswa, guru, dan tamu.</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                    <div class="work-process-items text-center">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="content">
                            <h4>Ruang Bimbingan Konseling</h4>
                            <p>Layanan konseling profesional untuk membantu siswa mengembangkan potensi diri dan mengatasi tantangan akademik maupun personal.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                    <div class="work-process-items text-center style-2">
                        <div class="icon bg-cover" style="background-image: url('assets/img/process/icon-bg.png');">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div class="content">
                            <h4>Kebun Edukasi & Green House</h4>
                            <p>Area belajar outdoor untuk mata pelajaran biologi, lingkungan, dan praktik pertanian berkelanjutan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Prestasi -->
<section class="testimonial-section fix section-padding">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="wow fadeInUp">Prestasi Nasional & Internasional</h2>
        </div>
        <div class="row text-center">
            <div class="col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <img src="{{ asset('img/juaracewebasket.jpg') }}" class="img-fluid rounded mb-3" alt="basket">
                <h5>Juara 2 Turnamen Basket Wanita</h5>
                <p>Tim basket putri SMKN 1 Manokwari berhasil meraih juara pertama dalam Turnamen Basket Wanita Antar Sekolah se-Manokwari. Dalam laga final, mereka mengalahkan SMA Negeri 3 Manokwari dengan skor 58–46. Permainan solid, strategi cerdas, dan kekompakan tim menjadi kunci kemenangan. Nadira Putri, sang kapten, tampil gemilang dan dinobatkan sebagai pemain terbaik. Pelatih Ibu Ratna Dewi mengaku bangga atas
                    kerja keras timnya. Selain menjadi juara, tim ini juga meraih penghargaan "Best Teamwork". Prestasi ini menjadi kebanggaan sekolah dan motivasi untuk melangkah ke tingkat provinsi..</p>
            </div>
            <div class="col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <img src="{{ asset('img/basketcowo.jpg') }}" class="img-fluid rounded mb-3" alt="basket">
                <h5>Juara 1 Turnamen Basket Internasional</h5>
                <p>Tim basket pria SMKN 1 Manokwari meraih juara pada Turnamen Basket Internasional Pelajar 2025 dengan kemenangan telak atas tim Thailand, skor akhir 82–54. Sejak awal pertandingan, tim tampil dominan dengan strategi matang, serangan cepat, dan pertahanan solid. Kapten tim, Rizky Maulana, mencetak 28 poin dan dinobatkan sebagai pemain terbaik (MVP) turnamen. Pelatih Bapak Ardiansyah menyatakan bahwa kemenangan ini adalah buah dari kerja keras, disiplin, dan semangat juang tinggi para pemain. Prestasi ini menjadi kebanggaan besar bagi sekolah serta membuktikan bahwa SMKN 1 Manokwari mampu bersaing di tingkat internasional.

                </p>
            </div>
        </div>
    </div>
</section>


<section class="cta-section fix section-padding bg-cover" style="background-image: url('{{ asset('assets/img/cta/cta-bg.jpg') }}');">
    <div class="container text-center">
        <h2 class="text-white">Siap Bergabung?</h2>
        <p class="lead text-white">Ayo, segera daftar sekarang dan menjadi bagian dari sekolah impian kamu!</p>
        @guest
            <a href="{{ route('register') }}" class="theme-btn bg-white">
                Daftar Sekarang <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        @endguest
    </div>
</section>


@endsection

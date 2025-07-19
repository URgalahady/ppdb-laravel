<div class="header-top-section">
    <div class="header-top-shape">
        <img src="{{ asset('assets/img/header-top-shape.png') }}" alt="shape-img">
    </div>
    <div class="container-fluid">
        <div class="header-top-wrapper d-flex justify-content-between align-items-center">
            <ul class="contact-list">
                <li><i class="fal fa-map-marker-alt"></i> Jl. Pendidikan No.88, Manokwari</li>
                <li><i class="far fa-envelope"></i> <a href="mailto:info@smkn8.sch.id">info@smkn8.sch.id</a></li>
            </ul>
            <div class="social-icon d-flex align-items-center">
                <span>Follow Us On:</span>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>

<header id="header-sticky" class="header-1">
    <div class="container-fluid">
        <div class="mega-menu-wrapper">
            <div class="header-main style-2 d-flex justify-content-between align-items-center">
                <div class="header-left d-flex align-items-center">
                    <div class="logo">
                        {{-- Ganti dengan logo yang sesuai. Contoh: --}}
                        {{-- <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/your-logo.png') }}" alt="Logo Sekolah"></a> --}}
                    </div>
                </div>
                <div class="header-right d-flex align-items-center">
                    <nav class="main-menu d-none d-xl-block">
                        <ul id="mainNavigationLinks"> {{-- <--- Tambahkan ID ini untuk menu desktop --}}
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="{{ route('about') }}">Tentang Sekolah</a></li>
                            <li><a href="{{ route('prestasi') }}">Prestasi</a></li>
                            <li><a href="{{ route('profile') }}">Profil</a></li>
                            
                        </ul>
                    </nav>

                    @auth
                        <div class="header-button ms-4">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="theme-btn">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="header-button ms-4">
                            <a href="{{ route('login') }}" class="theme-btn">Login</a>
                        </div>
                    @endauth

                    <div class="header__hamburger d-xl-none my-auto">
                        {{-- Ganti div dengan button dan tambahkan ID untuk mengaktifkan off-canvas --}}
                        <button class="sidebar__toggle" id="offcanvasToggler"> {{-- <--- PERUBAHAN DI SINI --}}
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="fix-area">
    <div class="offcanvas__info">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__content">
                <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo">
                        
                    </div>
                    <div class="offcanvas__close">
                        <button id="offcanvasCloseButton"> {{-- <--- Tambahkan ID ini untuk tombol close --}}
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
              
                <div class="mobile-menu fix mb-3">
                    {{-- Ini adalah placeholder untuk menu utama dari desktop yang akan dikloning --}}
                    <ul id="mobileNavigationPlaceholder">
                        {{-- Konten menu akan diisi oleh JavaScript --}}
                    </ul>

                    {{-- Tombol Login/Logout untuk Mobile Menu --}}
                    <div class="mobile-auth-buttons mt-3">
                        @auth
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                               class="theme-btn w-100 mb-2">
                                Logout
                            </a>
                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="theme-btn w-100">Login</a>
                        @endauth
                    </div>
                </div>
                <div> 
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="{{ route('about') }}">Tentang Sekolah</a></li>
                            <li><a href="{{ route('prestasi') }}">Prestasi</a></li> 
                             <li><a href="{{ route('profile') }}">Profile</a></li> 
                              

                </div>
                <div class="offcanvas__contact">
                    <h4>Contact Info</h4>
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a target="_blank" href="#"> Jl. Pendidikan No.88, Manokwar</a>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="mailto:info@example.com"><span class="mailto:info@example.com"> info@smkn1manokwari.sch.id</span></a>
                            </div>
                        </li>
                        
                        <li class="d-flex align-items-center">
                            <div class="offcanvas__contact-icon mr-15">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="offcanvas__contact-text">
                                <a href="tel:+11002345909">+11002345909</a>
                            </div>
                        </li>
                    </ul>
                    <div class="header-button mt-4">
                        <a href="contact.html" class="theme-btn text-center">
                            <span>Get A Quote<i class="fa-solid fa-arrow-right-long"></i></span>
                        </a>
                    </div>
                    <div class="social-icon d-flex align-items-center">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas-overlay" id="offcanvasOverlay"></div>


<!-- Footer Section Start -->
<footer class="footer-section section-bg fix">
    <div class="footer-top-shape">
        <img src="{{ asset('assets/img/footer-top.png') }}" alt="shape-img">
    </div>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-widget">
                    <div class="footer-logo mb-4">
                        
                    </div>
                    <p>Sekolah Menengah Kejuruan Negri 1 Manokwari – Pusat Pendidikan dan Pelatihan Vokasi Terdepan.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-widget">
                    <h4>Kontak</h4>
                    <ul class="footer-links">
                        <li><i class="fa fa-map-marker-alt"></i> Jl. Pendidikan No.88, Manokwari</li>
                        <li><i class="fa fa-phone"></i> <a href="tel:+6208123456789">+62 0812-3456-789</a></li>
                        <li><i class="fa fa-envelope"></i> <a href="mailto:info@smkn8.sch.id">info@smkn8.sch.id</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-widget">
                    <h4>Tautan Penting</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">Tentang Sekolah</a></li>
                        <li><a href="#">PPDB Online</a></li>
                        <li><a href="{{ route('konseling.index') }}">Layanan Konseling</a></li>
                        <li><a href="{{ route('kontak.form') }}">Hubungi Kami</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center mt-4 pt-3 border-top">
            <p class="mb-0">&copy; {{ date('Y') }} SMKN 8 Sukamiskin. All rights reserved.</p>
        </div>
    </div>
</footer>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ======== Page title ============ -->
    <title>{{ config('app.name', 'SMKN 1 Manokwa') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/ppdb.svg') }}">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>

 
    <!-- Header Section -->
    @include('partials.header') {{-- Pastikan kamu buat file partials/header.blade.php --}}

    <!-- Content Section -->
    <main>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer Section -->
    @include('partials.footer') 

    <!-- JS Assets -->
    <!-- jQuery utama dulu -->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<!-- Plugin pendukung -->
<script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>
<script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Animasi khusus -->
<script src="{{ asset('assets/js/animation.js') }}"></script>

<!-- AJAX Mail (jika digunakan) -->
<script src="{{ asset('assets/js/ajax-mail.js') }}"></script>

<!-- Script utama template -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Inisialisasi WOW.js -->
<script>
    new WOW().init();
</script>{{-- Di resources/views/layouts/app.blade.php atau di view lainnya --}}

{{-- Pastikan ini ada di bagian <head> atau di mana Bootstrap JS di-load --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cari semua elemen alert Bootstrap
        var alerts = document.querySelectorAll('.alert');

        alerts.forEach(function(alert) {
            // Jika alert memiliki kelas 'alert-dismissible' (ada tombol close)
            if (alert.classList.contains('alert-dismissible')) {
                // Atur timer untuk menghilangkan alert setelah 3 detik (3000 milidetik)
                setTimeout(function() {
                    // Gunakan fungsi dismiss dari Bootstrap untuk menutup alert
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 3000); // 3000 milidetik = 3 detik
            }
        });
    });
</script>


    @stack('scripts')
</body>
</html>

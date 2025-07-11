<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ======== Page title ============ -->
    <title>{{ config('app.name', 'SMKN 1 Manokwari') }}</title>

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

 
  
    <!-- Content Section -->
    <main>
        @yield('content')
    </main>



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
</script>


    @stack('scripts')
</body>
</html>

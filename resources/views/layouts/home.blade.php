<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>{{ 'Barakat Tarim - ' . $title }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

  <!-- Favicon -->
  <link href="{{ url('/assets/img/logo/bt2.png') }}" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
    rel="stylesheet" />

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('assets/css/home/bootstrap.min.css') }}" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="{{ asset('assets/css/home/style.css') }}" rel="stylesheet" />

  {{-- Jquery --}}
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

  {{-- Midtrans JS --}}
  @stack('midtrans')
</head>

<body>
  <div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <x-home.spinner />
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <x-home.navbar.navbar :carts="$carts ?? ''" />
    {{-- Navbar End --}}

    <!-- Hero Start -->
    <x-home.hero.hero />
    <!-- Hero End -->

    {{-- Content Start --}}
    @yield('content')
    {{-- Content End --}}

    <!-- Footer Start -->
    <x-home.footer />
    <!-- Footer End -->

    <!-- Button Back to Top Start -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
      <i class="bi bi-arrow-up"></i>
    </a>
    <!-- Button Back to Top End -->

    {{-- Loading Start --}}
    <x-home.loading />
    {{-- Loading End --}}
  </div>

  <!-- JS Libraries and Main JS -->
  <x-home.scripts />
</body>

</html>
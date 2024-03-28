<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ 'Barakat Tarim - ' . $title ?? config('app.name') }}</title>

    <!-- Favicon -->
    <link href="{{ url('/assets/img/logo/bt2.png') }}" rel="icon" />

    {{-- FontAwesome Free --}}
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Bootstrap --}}
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Ruang Admin --}}
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">

    {{-- My Style --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    {{-- DataTables --}}
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/responsive-datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/datatable-colreorder/css/colReorder.bootstrap4.min.css') }}" rel="stylesheet" />

    {{-- SweetAlert 2 and IziToast --}}
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">

    {{-- Loader on load --}}
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">

    {{-- Loader on ajax --}}
    <link rel="stylesheet" href="{{ asset('assets/css/load-ajax.css') }}">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <x-dashboard.sidebar :transaction="$transaction" />

        <!-- Aside -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <x-dashboard.topbar />

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">

                    {{-- Content --}}
                    @yield('content')

                    <!-- Modal Logout -->
                    <x-dashboard.modal_logout />

                </div>
                <!---Container Fluid-->
            </div>

            <!-- Footer -->
            <x-dashboard.footer />
        </div>
    </div>

    <!-- Preloader Area Start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- Preloader Area End -->

    <!-- Preloader Ajax Area Start -->
    <div id="preloaderAjax" class="d-none">
        <div class="loaderAjax"></div>
    </div>
    <!-- Preloader Ajax Area End -->

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- JQuery --}}
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

    {{-- Bootstrap --}}
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- JQuery Easing --}}
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    {{-- Ruang Admin --}}
    <script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>

    {{-- DataTables --}}
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/responsive-datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/responsive-datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatable-colreorder/js/colReorder.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatable-colreorder/js/dataTables.colReorder.min.js') }}"></script>

    {{-- SweetAlert 2 and IziToast --}}
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>

    {{-- Config --}}
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/home/methods.js') }}"></script>

    {{-- Loader on load --}}
    <script src="{{ asset('assets/js/loader.js') }}"></script>

    {{-- Loader on ajax --}}
    <script src="{{ asset('assets/js/load-ajax.js') }}"></script>

    @stack('script')
</body>

</html>
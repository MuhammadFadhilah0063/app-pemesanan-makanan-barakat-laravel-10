<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/img/logo/logo2.png') }}" rel="icon" type="image/png">
    <title>{{ 'Barakat Tarim - ' . $title ?? config('app.name') }}</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login d-flex justify-content-center align-items-center vh-100 bg-dark"
        style="background:url({{ asset('assets/img/auth-bg.jpg') }}) no-repeat center center; opacity: 0.9;">
        <div class="row justify-content-center" style="width: 100%">
            <div class="col-sm-10 col-md-7 col-lg-6 col-xl-5">
                <div class="card shadow-sm my-5" style="max-width: 470px">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}} "></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}} "></script>
    <script src="{{ asset('assets/js/ruang-admin.js')}} "></script>
</body>

</html>
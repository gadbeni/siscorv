<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SISCOR - Bienvenido</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('images/icon.png') }}" rel="icon">
    <link href="{{ asset('images/icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    @include('frontend.partials.style')
</head>

    <body>

        <!-- ======= Top Bar ======= -->
        <section id="topbar" class="d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:{{ setting('site.email') }}">{{ setting('site.email') }}</a></i>
                <i class="bi bi-telephone-fill d-flex align-items-center ms-4"><span><a href="{{ setting('site.telefono') }}">{{ setting('site.telefono') }}</a></span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="{{ setting('redes-sociales.twitter') }}" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="{{ setting('redes-sociales.facebook') }}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="{{ setting('redes-sociales.instagram') }}" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="{{ setting('redes-sociales.linkedin') }}" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
            </div>
        </section>

        @include('frontend.partials.header')

        @yield('content')

        @include('frontend.partials.footer')

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        
        @include('frontend.partials.script')
    </body>

</html>
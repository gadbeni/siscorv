<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

    <h1 class="logo"><a href="/">SIS<span>COR</span></a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

    <nav id="navbar" class="navbar">
        <ul>
        <li><a class="nav-link scrollto active" href="{{ url('/')}}">Inicio</a></li>
        <li><a class="nav-link scrollto" href="{{ route('services')}}">Servicios</a></li>
        <li><a class="nav-link scrollto" href="#counts">Información</a></li>
        <li><a class="nav-link scrollto" href="#contact">Contáctanos</a></li>
        <li><a class="nav-link scrollto" href="{{ route('voyager.login')}}">Administracion</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
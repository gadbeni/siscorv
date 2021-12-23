@extends('frontend.welcome')

@section('content')
 <!-- ======= Hero Section ======= -->
<!-- <section>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3947459/car.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3947459/sunset.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3947459/car.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
</section> -->
    <!-- End Hero -->
<main id="tramite">
    <!-- ======= Team Section ======= -->
    <section id="app" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
            <h2>SERVICIOS</h2>
            <h3>¿Qué <span>Necesitás Hacer?</span></h3>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">TODOS</li>
                        <li data-filter=".filter-app">TRÁMITES</li>
                        <!-- <li data-filter=".filter-card">TURISMO</li> -->
                    </ul>
                </div>
            </div>
            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-4 col-md-4 portfolio-item filter-app">
                    <a href="javascript:;" @click="showcontent('req')">
                        <img src="assets/img/team/obtenerpers.png" class="img-fluid" alt=""> 
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 portfolio-item filter-app">
                    <router-link to="/tree">
                    <img src="assets/img/team/disname.png" class="img-fluid" alt="">
                    </router-link>
                </div>
                <div class="col-lg-4 col-md-4 portfolio-item filter-app">
                   <router-link to="/tramites">
                        <img src="assets/img/team/segtramite.png" class="img-fluid" alt="">
                    </router-link>
                </div>
            </div>
        </div>
        <div class="container">
            <router-view></router-view>
        </div>
    </section><!-- End Team Section -->

    <section>
        
    </section>
</main><!-- End #main -->
@endsection()

@push('css')
    <style>
        .img-fluid:hover{
            opacity: .8;
        }
    </style>
@endpush
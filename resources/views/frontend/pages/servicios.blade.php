@extends('frontend.welcome')

@section('content')
<main id="tramite">
    <!-- ======= Team Section ======= -->
    <section id="app" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
            <h2>SERVICIOSs</h2>
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
                    <router-link to="/requisitos">
                        <img src="assets/img/team/obtenerpers.png" class="img-fluid" alt="">
                    </router-link>
                </div>
                <div class="col-lg-4 col-md-4 portfolio-item filter-app">
                    <router-link to="/personerias">
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
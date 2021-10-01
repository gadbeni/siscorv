@extends('frontend.welcome')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="row">
                <div class="col-md-7">
                    <h1>SIS<span>COR</span></h1>
                    <h2>{{ setting('site.description') }}</h2>
                    <div class="d-flex">
                        <a href="#counts" class="btn-get-started scrollto btn-more">Conoce más</a>
                        {{-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group mt-5 input-group-lg">
                        <input type="text" class="form-control" id="input-search" placeholder="Número de cite o HR" aria-label="" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                            <button class="btn btn-get-started" id="btn-search" type="button" style="height: 50px"><span class="sm-hide">Buscar</span> <span class="bi bi-search label-search"></span></button>
                        </div>
                    </div>
                    <p style="margin: 10px">Para hacer seguimiento de su trámite ingrese el <b>Número de Cite o el HR</b> y presion el botón <b>Buscar</b>.</p>
                </div>

                <form id="form-search" action="{{ route('home.search') }}" method="post">
                    @csrf
                    <input type="hidden" name="search" >
                </form>
            </div>
        </div>
    </section>
    <!-- End Hero -->
    
    <main id="main">
        <div class="container" data-aos="fade-up">
            <div id="div-search"></div>
        </div>

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                        <i class="bi bi-link-45deg"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ \App\Models\RequestsClient::count() }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Visitas</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                        <i class="bi bi-people-fill"></i>
                        @php
                            $usuarios = \App\Models\User::count();
                        @endphp
                        <span data-purecounter-start="0" data-purecounter-end="{{ $usuarios }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Usuarios registrados</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                        <i class="bi bi-mailbox"></i>
                        @php
                            $ingresos = \App\Models\Entrada::where('deleted_at', NULL)->get();
                        @endphp
                        <span data-purecounter-start="0" data-purecounter-end="{{ $ingresos->count() }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Trámites recibidos</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                        <i class="bi bi-clock"></i>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $ingresos->where('estado_id', 6)->count() }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Trámites Pendientes</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contácto</h2>
                    <h3><span>Contáctate con nosotros</span></h3>
                    <p>Para obtener más información puedes contactarnos por medio de cualquiera de los canales de comunicación descritos a continuación.</p>
                </div>

                <div class="row mt-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6 ">
                        <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.2034342454992!2d-64.90438077082753!3d-14.83570830295541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93dd6fd5b87370df%3A0x47918f6983c7c6c8!2sGobierno%20Aut%C3%B3nomo%20Departamental%20Del%20Beni!5e0!3m2!1ses-419!2sbo!4v1626364207037!5m2!1ses-419!2sbo" frameborder="0" style="border:0; width: 100%; height: 360px;" allowfullscreen></iframe>
                    </div>

                    <div class="col-lg-6">
                        <div class="row" data-aos="fade-up" data-aos-delay="100">
                            <div class="col-lg-12">
                                <div class="info-box mb-4">
                                <i class="bx bx-map"></i>
                                <h3>Nuestra Dirección</h3>
                                <p>{{ setting('site.direccion') }}</p>
                                </div>
                            </div>
        
                            <div class="col-lg-6 col-md-12">
                                <div class="info-box  mb-4">
                                <i class="bx bx-envelope"></i>
                                <h3>Nuestros Email</h3>
                                <p>{{ setting('site.email') }}</p>
                                </div>
                            </div>
        
                            <div class="col-lg-6 col-md-12">
                                <div class="info-box  mb-4">
                                <i class="bx bx-phone-call"></i>
                                <h3>Llámanos</h3>
                                <p>{{ setting('site.telefono') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection()

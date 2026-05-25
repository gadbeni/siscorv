@extends('frontend.welcome')

@push('css')
<style>
    /* ============================================================
       HERO - Fondo verde institucional fuerte
    ============================================================ */
    #hero {
        height: 88vh;
        min-height: 560px;
    }

    #hero:before {
        background: linear-gradient(
            115deg,
            rgba(5, 65, 20, 0.97) 0%,
            rgba(9, 132, 41, 0.93) 42%,
            rgba(9, 132, 41, 0.65) 65%,
            rgba(0, 0, 0, 0.05) 100%
        ) !important;
    }

    /* ---- Texto izquierdo: blanco sobre verde ---- */
    #hero h2 {
        color: rgba(255,255,255,0.82) !important;
        font-size: 16px !important;
        font-weight: 400 !important;
        margin-bottom: 32px !important;
        max-width: 480px;
        line-height: 1.6 !important;
    }

    /* ---- Badge institución ---- */
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: rgba(255,255,255,0.12);
        border: 1.5px solid rgba(255,255,255,0.30);
        color: rgba(255,255,255,0.90);
        font-size: 11px;
        font-weight: 700;
        padding: 7px 16px;
        border-radius: 50px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 22px;
    }
    .hero-badge .dot {
        width: 8px;
        height: 8px;
        background: #FFD700;
        border-radius: 50%;
        flex-shrink: 0;
        box-shadow: 0 0 0 3px rgba(255,215,0,0.25);
    }

    /* ---- Título principal ---- */
    .hero-title {
        font-size: 86px !important;
        font-weight: 900 !important;
        letter-spacing: -4px !important;
        line-height: 1 !important;
        color: #fff !important;
        margin: 0 0 6px 0 !important;
        text-shadow: 0 4px 24px rgba(0,0,0,0.25);
    }
    .hero-title span {
        color: #FFD700;
    }

    /* ---- Línea acento dorada ---- */
    .hero-accent {
        width: 64px;
        height: 5px;
        background: linear-gradient(90deg, #FFD700, rgba(255,215,0,0.3));
        border-radius: 3px;
        margin: 18px 0 22px 0;
    }

    /* ---- Botón CTA ---- */
    #hero .btn-get-started {
        background: #fff !important;
        color: #076b22 !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        padding: 12px 28px !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        border: none !important;
        transition: all 0.3s;
    }
    #hero .btn-get-started:hover {
        background: #FFD700 !important;
        color: #065018 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(0,0,0,0.2);
    }

    /* ---- Estrellas decorativas ---- */
    .hero-stars {
        display: flex;
        gap: 5px;
        margin-bottom: 18px;
    }
    .hero-stars i {
        color: #FFD700;
        font-size: 14px;
        filter: drop-shadow(0 1px 3px rgba(0,0,0,0.3));
    }

    /* ---- Search Card ---- */
    .search-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.22), 0 4px 12px rgba(0,0,0,0.10);
        padding: 32px;
        position: relative;
        overflow: hidden;
    }
    .search-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, #065018, #098429, #2FB251);
    }
    .search-card .card-header-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #065018, #098429);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        margin-bottom: 16px;
        box-shadow: 0 4px 12px rgba(9,132,41,0.35);
    }
    .search-card h5 {
        font-size: 18px;
        font-weight: 700;
        color: #111;
        margin-bottom: 6px;
    }
    .search-card .card-desc {
        font-size: 13px;
        color: #888;
        margin-bottom: 20px;
        line-height: 1.5;
    }
    .search-card .form-control {
        border: 1.5px solid #e0e0e0;
        border-right: none;
        border-radius: 10px 0 0 10px;
        font-size: 14px;
        height: 50px;
        padding: 0 16px;
        transition: border-color 0.2s;
    }
    .search-card .form-control:focus {
        border-color: #098429;
        box-shadow: none;
    }
    .search-card #btn-search {
        border-radius: 0 10px 10px 0 !important;
        height: 50px;
        padding: 0 24px;
        font-weight: 700;
        font-size: 14px;
        background: linear-gradient(135deg, #065018, #098429) !important;
        border: none !important;
        transition: all 0.2s;
    }
    .search-card #btn-search:hover {
        background: linear-gradient(135deg, #044013, #065018) !important;
        transform: translateX(1px);
    }
    .search-card .hint {
        font-size: 12px;
        color: #aaa;
        margin-top: 12px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* ---- Stats chips en hero ---- */
    .hero-stats {
        display: flex;
        gap: 20px;
        margin-top: 28px;
    }
    .hero-stat {
        text-align: center;
    }
    .hero-stat .stat-num {
        display: block;
        font-size: 22px;
        font-weight: 800;
        color: #FFD700;
        line-height: 1;
    }
    .hero-stat .stat-label {
        font-size: 11px;
        color: rgba(255,255,255,0.65);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .hero-stat-divider {
        width: 1px;
        background: rgba(255,255,255,0.2);
        align-self: stretch;
    }

    /* ---- Counts Section ---- */
    .counts .section-title h2 {
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #098429;
        font-family: "Poppins", sans-serif;
    }
    .counts .section-title h3 {
        margin: 12px 0 0;
        font-size: 30px;
        font-weight: 700;
        color: #222;
    }
    .counts .section-title h3 span { color: #098429; }

    /* ---- Responsive ---- */
    @media (max-width: 767px) {
        .sm-hide { display: none !important; }
        .label-search { font-size: 20px; }
        .hero-title { font-size: 52px !important; letter-spacing: -2px !important; }
        #hero { height: auto; padding: 50px 0 40px; }
        .search-card { margin-top: 32px; }
        .hero-stats { gap: 12px; }
        .hero-badge { font-size: 9px; }
    }
</style>
@endpush

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="row align-items-center">

                <!-- Left: Branding institucional -->
                <div class="col-lg-6 col-md-7">

                    <!-- Estrellas (como en el logo del GADBENI) -->
                    <div class="hero-stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>

                    <!-- Badge institución -->
                    <div class="hero-badge">
                        <span class="dot"></span>
                        Gobierno Autónomo Departamental del Beni
                    </div>

                    <!-- Título -->
                    <h1 class="hero-title">SIS<span>COR</span>V</h1>
                    <div class="hero-accent"></div>

                    <h2>{{ setting('site.description') }}</h2>

                    <div class="d-flex">
                        <a href="#counts" class="btn-get-started scrollto">Conoce más</a>
                    </div>

                    <!-- Mini stats debajo del CTA -->
                    <div class="hero-stats mt-4">
                        <div class="hero-stat">
                            <span class="stat-num">{{ number_format($count['tramites']) }}</span>
                            <span class="stat-label">Trámites</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="stat-num">{{ number_format($count['usuarios']) }}</span>
                            <span class="stat-label">Usuarios</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="stat-num">{{ number_format($count['visitas']) }}</span>
                            <span class="stat-label">Visitas</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Search card -->
                <div class="col-lg-5 col-md-5 offset-lg-1 mt-5 mt-md-0">
                    <div class="search-card" data-aos="fade-left" data-aos-delay="200">
                        <div class="card-header-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h5>Seguimiento de Trámites</h5>
                        <p class="card-desc">
                            Consulte el estado de su trámite ingresando el número de cite o HR asignado.
                        </p>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="input-search"
                                   placeholder="Ej: CITE-2025-001 o HR-123"
                                   aria-label="Buscar trámite">
                            <button class="btn btn-get-started" id="btn-search" type="button">
                                <span class="sm-hide">Buscar</span>
                                <span class="bi bi-search label-search"></span>
                            </button>
                        </div>
                        <p class="hint">
                            <i class="bi bi-info-circle"></i>
                            Ingrese el <b>Número de Cite o HR</b> y presione <b>Buscar</b>.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <form id="form-search" action="{{ route('home.search') }}" method="post" class="d-none">
            @csrf
            <input type="hidden" name="search">
        </form>
    </section>
    <!-- End Hero -->

    <main id="main">
        <div class="container" data-aos="fade-up">
            <div id="div-search"></div>
        </div>

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="section-title text-center">
                    <h2>Estadísticas</h2>
                    <h3>Sistema en <span>Números</span></h3>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="bi bi-link-45deg"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count['visitas'] }}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Visitas</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-people-fill"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count['usuarios'] }}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Usuarios registrados</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="bi bi-mailbox"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count['tramites'] }}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Trámites recibidos</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="bi bi-clock"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $count['tramites_pendientes'] }}" data-purecounter-duration="1" class="purecounter"></span>
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
                    <h2>Contacto</h2>
                    <h3><span>Contáctate con nosotros</span></h3>
                    <p>Para obtener más información puedes contactarnos por medio de cualquiera de los canales de comunicación descritos a continuación.</p>
                </div>

                <div class="row mt-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-6">
                        <iframe class="mb-4 mb-lg-0"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.2034342454992!2d-64.90438077082753!3d-14.83570830295541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93dd6fd5b87370df%3A0x47918f6983c7c6c8!2sGobierno%20Aut%C3%B3nomo%20Departamental%20Del%20Beni!5e0!3m2!1ses-419!2sbo!4v1626364207037!5m2!1ses-419!2sbo"
                                frameborder="0"
                                style="border:0; width: 100%; height: 360px;"
                                allowfullscreen></iframe>
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
                                <div class="info-box mb-4">
                                    <i class="bx bx-envelope"></i>
                                    <h3>Nuestros Email</h3>
                                    <p>{{ setting('site.email') }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="info-box mb-4">
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
@endsection

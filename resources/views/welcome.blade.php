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

    <!-- Vendor CSS Files -->
    <link href="{{ asset('lp/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('lp/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lp/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('lp/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lp/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lp/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <style>
        #btn-search{
            border-radius: 0px 5px 5px 0px !important
        }
        @media (max-width: 767px) {
            .btn-more, .sm-hide{
                display: none !important
            }
            .label-search{
                font-size: 20px
            }
        }
    </style>

  <!-- Template Main CSS File -->
  <link href="{{ asset('lp/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand - v3.3.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="index.html">SIS<span>COR</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

        <nav id="navbar" class="navbar">
            <ul>
            <li><a class="nav-link scrollto active" href="#hero">Inicio</a></li>
            <li><a class="nav-link scrollto" href="#services">Servicios</a></li>
            <li><a class="nav-link scrollto" href="#counts">Información</a></li>
            <li><a class="nav-link scrollto" href="#contact">Contáctanos</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

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
    </section><!-- End Hero -->
    <main id="main">
        <div class="container" data-aos="fade-up">
            <div id="div-search"></div>
        </div>

         <!-- ======= Team Section ======= -->
        <section id="app" class="team section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                <h2>SERVICIOS</h2>
                <h3>¿Qué <span>Necesitás Hacer?</span></h3>
                <p>Nuestra prioridad eres tú</p>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                        <div class="member-img">
                            <img src="assets/img/team/prsjuridica.jpg" class="img-fluid" alt="">
                            <div class="social">
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>
                                <a href="javascript:;" @click="showcontent('req')">
                                    DISPONIBILIDAD DE NOMBRE PARA PERSONALIDAD JURIDICA
                                </a>
                            </h4>
                        </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                        <div class="member-img">
                            <img src="assets/img/team/getperson.jpg" class="img-fluid" alt="">
                            <div class="social">
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>
                            <a href="javascript:;" @click="showcontent('find')">
                            OBTENER PERSONALIDAD JURIDICA
                            </a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="container" data-aos="fade-up">
                    <div id="div-requirement" style="display:none">
                        <h3>¿Cuáles son los requisitos para solicitar la reserva de nombre?</h3>
                        <h5>PERSONERIA JURIDICA PARA: Asociaciones, Fundaciones, ONG, Sindicatos</h5>
                        <div>
                            <h6 class="text-danger">TRAMITE</h6>
                            <P>1. Solicitud Certificado de reserva de nombre otorgado por la instancia correspondiente 
                                <strong>(Secretaria de Justicia)</strong>
                            </P>
                            <h6 class="text-danger">REQUISITOS:</h6>
                            <P>2. Realizar una carta de solicitud de Reserva de nombre, dirigida al 
                                <strong>Gobernador: Dr. José Alejandro Unzueta Shiriqui</strong>
                            </P>
                            <h6 class="text-danger">DOCUMENTOS PARA  PERSONERIA JURIDICA :</h6>
                            <P> Solicitud de Personería Jurídica dirigida al Dr.  
                                <strong>José Alejandro Unzueta Shiriqui/ GOBERNADOR DPTAL DEL BENI</strong>
                            </P>
                            <P> Depósito Bancario de Valores Bs. 50 a la CTA.CTE. N°   
                                <strong>10000004707896 Banco Unión</strong>
                            </P>
                            <p> Depósito Bancario de Valores Bs.650 a la  CTA.CTE. N°<strong>10000004707896 Banco Unión.</strong></p>
                            <p> ACTA DE FUNDACION (Fotocopia refrendada por notario de Fe Publica)</p>
                            <p> ACTA DE ELECCION Y POSESION (Fotocopia refrendada por notario de Fe Publica)</p>
                            <p> ESTATUTO ORGANICO (debidamente firmada por el Directorio o representante)</p>
                            <p> REGLAMENTO INTERNO (debidamente firmado por el Directorio y/o representante legal)</p>
                            <p> NOMINA DE SOCIOS (Fotocopias de C.I. Diez socios como mínimo)</p>
                            <p> TRANSCRIPCION DEL ESTATUTO y/o REGLAMENTO EN CD. </p>
                            <p> PRESETNACION DEL LIBRO ORIGINAL DE ACTAS </p>
                            <p> Poder Notariado (Ley 351 Art. 6 N°5)</p>
                            <p> Registro Domiciliario de la Organización social otorgado por la policía</p>
                        </div>
                    </div>
                    <div id="div-findpersoneria" style="display:none">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="input-group mt-5 input-group-lg">
                                    <input v-model="search" type="text" class="form-control" placeholder="Número de tramite" aria-label="" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <button @click="getDatos" class="btn btn-success" style="height: 50px"><span class="sm-hide">Buscar</span> <span class="bi bi-search label-search"></span></button>
                                    </div>
                                </div>
                                <p style="margin: 10px">@{{ msg }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-center"  v-if="cont < 1">
                            <h4>Descarga los reguisitos aqui.</h4>
                            <a href="{{ asset('assets/PERSONERIAJURIDICA.pdf') }}" class="btn btn-primary" target="_blank">Descargar</a>
                        </div>
                        <ol>
                            <li v-for="todo in datos">
                                <span class="text-success">@{{ todo.razon_social }}</span>  
                                <strong> PROVINCIA: </strong> @{{ todo.provincia }}
                                <strong> MUNICIPIO: </strong> @{{ todo.municipio }}
                                <strong> LOCALIDAD: </strong> @{{ todo.localidad }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section><!-- End Team Section -->

        

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

        <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="container py-4">
                <div class="copyright">
                    &copy; Copyright <strong><span>GADBENI</span></strong> {{ date('Y') }}. Todos los derechos reservados
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bizland-bootstrap-business-template/ -->
                    Desarrollado por <a href="#"> Unidad de Desarrollo de Software</a>
                </div>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('js/vue3.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{ asset('lp/assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('lp/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('lp/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('lp/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('lp/assets/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('lp/assets/vendor/purecounter/purecounter.js') }}"></script>
        <script src="{{ asset('lp/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('lp/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('lp/assets/js/main.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $('#btn-search').click(function(){
                    let search = $('#input-search').val();
                    if(search){
                        $('#form-search input[name="search"]').val($('#input-search').val());
                        window.location = './#div-search';
                        $.post($('#form-search').attr('action'), $('#form-search').serialize(), function(res){
                            $('#div-search').html(res);
                        });
                    }
                });
            });

            const ListRenderingApp = {
                data() {
                    return {
                        search: '',
                        cont : 1,
                        msg: 'Verificá el estado de tu trámite',
                        datos: []
                    }
                },
                methods: {
                    async getDatos() {
                        try {
                            const response = await axios.get('/consultas?search='+this.search);
                            let res = response.data;
                            this.datos = res.data;
                            this.msg = res.message;
                            this.cont = res.cont;
                            console.log(this.cont);
                        } catch (error) {
                            console.error(error);
                        }
                    },
                    showcontent(info){
                        if (info == "find") {
                            $('#div-findpersoneria').fadeIn();
                            $('#div-requirement').fadeOut();
                        }else{
                            this.search = '';
                            this.cont = 1;
                            this.msg = 'Verificá el estado de tu trámite';
                            this.datos = [];
                            $('#div-requirement').fadeIn();
                            $('#div-findpersoneria').fadeOut();
                        }
                    }
                }
            }
            Vue.createApp(ListRenderingApp).mount('#app')
        </script>

    </body>

</html>
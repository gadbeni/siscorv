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
                    <a href="javascript:;" @click="showcontent('tramite')">
                        <img src="assets/img/team/disname.png" class="img-fluid" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 portfolio-item filter-app">
                    <a href="javascript:;" @click="showcontent('siscor')">
                        <img src="assets/img/team/segtramite.png" class="img-fluid" alt="">
                    </a>
                </div>
            </div>
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
            <div class="container col-md-10 col-md-offset-1" data-aos="fade-up">
                <div id="div-findpersoneria" style="display:none" >
                    <div class="input-group mt-5 input-group-lg">
                        <input v-model="search" type="text" class="form-control" :placeholder="textplaceholder" aria-label="" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                            <button @click="getDatos" class="btn btn-success" style="height: 50px"><span class="sm-hide">Buscar</span> <span class="bi bi-search label-search"></span></button>
                        </div>
                    </div>
                    <p style="margin: 10px">@{{ msg }}</p>
                </div>
                <div>
                    <div class="text-center"  v-if="cont < 1">
                        <h4>Descarga los reguisitos aqui.</h4>
                        <a href="{{ asset('assets/REQUISITOSPERSONERIAJURIDICA.pdf') }}" class="btn btn-primary" target="_blank">Descargar</a>
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

    <section  >
        <template v-if="tramite">
            <div class="section-title" style="margin-top: 50px">
                <h2>Seguimiento</h2>
                <h3><span>Seguimiento del Trámite</span></h3>
                <p>La siguiente información te muestra el historial de tu trámite.</p>
            </div>
            <div class="row m-5">
                <div class="col-md-6">
                    <div class="panel-body" style="padding-top:0;">
                        <p>Hoja de Ruta</p>
                    </div>
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">@{{ tramite.tipo +'-'+ tramite.gestion +'-'+ tramite.id}}</h3>
                    </div>
                </div>
                <div class="col-md-6" style="text-align: right">
                    <div class="panel-body" style="padding-top:0;">
                        <p>Fecha de ingreso</p>
                    </div>
                    <div class="panel-heading" style="border-bottom:0;">
                        <h5 class="panel-title">@{{ tramite.created_at }}<small></small></h5>
                    </div>
                </div>
                <hr>
                <div class="col-md-12 mt-1">
                    <b>Número de Cite: </b> &nbsp; @{{ tramite.cite }} <br>
                    <b>Número de hojas: </b> &nbsp; @{{ tramite.nro_hojas }} <br>
                    <b>Origen: </b> &nbsp; @{{ tramite ? tramite.entity.nombre : '' }}<br>
                    <b>Remitente: </b> &nbsp; @{{ tramite.remitente }} <br>
                    <b>Referencia: </b> &nbsp; @{{ tramite.referencia }} <br>
                    <b>Estado: </b> &nbsp; <span :style="{ backgroundColor : tramite.estado.color }">@{{ tramite.estado.nombre }}</span>
                </div>
            </div>
            <div v-if="tramite.derivaciones.length > 0">
                <div class="row m-5">
                    <div class="col-md-12">
                        <h4 style="text-decoration: underline">Historial de derivaciones</h4>
                    </div>
                    <ul class="timeline">
                        <li class="timeline-inverted" v-for="item in tramite.derivaciones">
                            <div class="timeline-badge primary"><i class="bi bi-check-lg"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">@{{ item.funcionario_direccion_para }}</h4>
                                    <h6>@{{ item.funcionario_nombre_para }} | <small>@{{ item.funcionario_cargo_para }}</small></h6>
                                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> @{{ item.created_at }}</small></p>
                                </div>
                                <div class="timeline-body">
                                    <p>@{{ item.observacion }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </template>
        <template v-show="trempty" class="row">
            <div class="col-md-12 text-center mt-3">
                <img src="images/not-found.png" width="150px" alt="Not Found">
                <h3 class="text-muted mt-3">Trámite no encontrado</h3>
            </div>
        </template>
        <hr>
    </section>

    <OrgChart />
</main><!-- End #main -->
@endsection()

@push('css')
    <style>
        .img-fluid:hover{
            opacity: .8;
        }
    </style>
@endpush
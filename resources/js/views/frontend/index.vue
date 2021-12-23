<template>
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
                   <router-link to="/tramites">
                     <img src="assets/img/team/segtramite.png" class="img-fluid" alt="">
                </router-link>
                </div>
            </div>
        </div>
    </section><!-- End Team Section -->
</template>

<script>
export default {
    data() {
        return {
            showcontent: 'req'
        }
    },
    methods: {
       
    }
}
</script>
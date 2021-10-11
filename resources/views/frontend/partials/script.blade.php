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
                tipo: 'tramite',
                search: '',
                textplaceholder: '',
                cont : 1,
                msg: '',
                datos: [],
                trempty: false,
                tramite: null,
            }
        },
        methods: {
            async getDatos() {
                try {
                    if (this.tipo == "siscor") {
                        const response = await axios.get('/buscartramite?search='+this.search);
                        if (!Object.keys(response.data).length) {
                            this.tramite = null;
                            this.trempty = true
                        }else{
                            this.trempty = false
                            this.tramite = response.data;
                        }
                        
                    }else{
                        const response = await axios.get('/consultas?search='+this.search);
                        let res = response.data;
                        this.datos = res.data;
                        this.msg = res.message;
                        this.cont = res.cont;
                    }
                } catch (error) {
                    console.error(error);
                }
            },
            showcontent(info){
                if (info == "tramite") {
                    this.search = '';
                    this.tipo = info;
                    this.tramite = null;
                    $('#div-findpersoneria').fadeIn();
                    $('#div-requirement').fadeOut();
                    this.textplaceholder = "Introduzca el nombre a buscar..";
                    this.msg = 'Verifica el estado de tu trámite';
                    this.trempty = false;
                } else if(info == "siscor"){
                    this.cont = 1;
                    this.tipo = info;
                    $('#div-findpersoneria').fadeIn();
                    $('#div-requirement').fadeOut();
                    this.textplaceholder = "Número de Cite o HR";
                    this.search = '';
                    this.datos = [];
                    this.msg = 'Para hacer seguimiento de su trámite ingrese el Número de Cite o el HR y presion el botón Buscar.';
                }
                else{
                    this.search = '';
                    this.cont = 1;
                    this.tramite = null,
                    this.msg = '';
                    this.datos = [];
                    $('#div-requirement').fadeIn();
                    $('#div-findpersoneria').fadeOut();
                    this.trempty = false;
                }
            }
        }
    }
    Vue.createApp(ListRenderingApp).mount('#main')
</script>
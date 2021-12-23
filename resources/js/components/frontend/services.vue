<template>
    
</template>

<script>
export default defineComponent({
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
})
</script>

<style scoped>

</style>
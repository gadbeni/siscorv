<template>
<div>
    <div class="container col-md-10 col-md-offset-1">
        <div class="input-group mt-5 input-group-lg">
            <input v-model="search" type="text" class="form-control" :placeholder="textplaceholder" aria-label="" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
                <button @click="getDatos" class="btn btn-success" style="height: 50px"><span class="sm-hide">Buscar</span> <span class="bi bi-search label-search"></span></button>
            </div>
        </div>
        <template v-if="tramite">
            <div class="section-title" style="margin-top: 50px">
                <h2>Seguimiento</h2>
                <h3><span>Seguimientos del Trámite</span></h3>
                <p>La siguiente información te muestra el historial de tu trámite.</p>
            </div>
            <div class="row m-5">
                <div class="col-md-6">
                    <div class="panel-body" style="padding-top:0;">
                        <p>Hoja de Ruta</p>
                    </div>
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">{{ tramite.tipo +'-'+ tramite.gestion +'-'+ tramite.id}}</h3>
                    </div>
                </div>
                <div class="col-md-6" style="text-align: right">
                    <div class="panel-body" style="padding-top:0;">
                        <p>Fecha de ingreso</p>
                    </div>
                    <div class="panel-heading" style="border-bottom:0;">
                        <h5 class="panel-title">{{ tramite.created_at }}<small></small></h5>
                    </div>
                </div>
                <hr>
                <div v-if="tramite" class="col-md-12 mt-1">
                    <b>Número de Cite: </b> &nbsp; {{ tramite.cite }} <br>
                    <b>Número de hojas: </b> &nbsp; {{ tramite.nro_hojas }} <br>
                    <b>Origen: </b> &nbsp; {{ tramite ? tramite.entity.nombre : '' }}<br>
                    <b>Remitente: </b> &nbsp; {{ tramite.remitente }} <br>
                    <b>Referencia: </b> &nbsp; {{ tramite.referencia }} <br>
                    <b>Estado: </b> &nbsp; <span :style="{ backgroundColor : tramite.estado.color }">{{ tramite ? tramite.entity.nombre : '' }}</span>
                </div>
            </div>
            <div v-if="tramite.derivaciones.length > 0">
                <div class="row m-5">
                    <div class="col-md-12">
                        <h4 style="text-decoration: underline">Historial de derivaciones</h4>
                    </div>
                    <ul class="timeline">
                        <li class="timeline-inverted" v-for="item in tramite.derivaciones" :key="item.id">
                            <div class="timeline-badge primary"><i class="bi bi-check-lg"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">{{ item.funcionario_direccion_para }}</h4>
                                    <h6>{{ item.funcionario_nombre_para }} | <small>{{ item.funcionario_cargo_para }}</small></h6>
                                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ item.created_at }}</small></p>
                                </div>
                                <div class="timeline-body">
                                    <p>{{ item.observacion }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="section-title" style="margin-top: 50px">
                 <h3 class="text-muted mt-3">{{ msg}}</h3>
            </div>
        </template>
    </div>
    <div id="app">
        <div id="tree" ref="tree"></div>
    </div>
</div>
</template>
<script>
import axios from 'axios';
import OrgChart from '@balkangraph/orgchart.js'
export default {
    data() {
        return {
            search: '',
            textplaceholder: 'Número de Cite o HR',
            msg: '',
            tramite: null,
            nodes : []
        }
    },

    methods: {
        getDatos(){
            try {
                axios.get('/buscartramite?search='+this.search)
                     .then((res) => {
                            this.tramite = response.data.entrada;
                            this.nodes = response.data.derivaciones;
                            this.msg = '';
                            this.oc(this.$refs.tree, this.nodes);
                     }).error((err) => {
                         log.error(err);
                     });
            } catch (error) {
                
            }
        },
        // async getDatos() {
        //     try{
        //         const response = await axios.get('/buscartramite?search='+this.search);
        //         console.log(response);
        //         if (!Object.keys(response.data).length) {
        //             this.tramite = null;
        //             this.nodes = [];
        //             this.msg = 'No se encontraron resultados';
        //         }else{
        //             this.tramite = response.data.entrada;
        //             this.nodes = response.data.derivaciones;
        //             this.msg = '';
        //             this.oc(this.$refs.tree, this.nodes);
        //         }
              
        //     } catch (error) {
        //         console.error(error);
        //     }
        // },
        oc: function(domEl, x) {
            this.chart = new OrgChart(domEl, {
                nodes: x,
                nodeBinding: {
                    field_0: "name",
                    field_1: "title",
                    img_0: "img"
                }
            });
        },
    }
}
</script>
<style scoped>
#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}

html, body {
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
    overflow: hidden;
    font-family: Helvetica;
}

#tree {
    width: 100%;
    height: 100%;
}
</style>
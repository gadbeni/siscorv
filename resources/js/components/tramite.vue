<template>
  <div>
    <div v-if="processing" class="alert alert-primary text-center" >
      <img src="/arhist/images/preloader.gif" />
    </div>
  </div>
</template>
<script>
 import {Event} from 'vue-tables-2'
export default{
    name: "documentos",
    props: {
      labels: {
        type: Object,
        required : true
      },
      route: {
        type: String,
        required : true
      }
    },
    mounted: function(){
     this.fetchtipostramites();
    },
	data(){
	  return {
	    processing: false,
	    tiposdocumento_id: null,
	    tipostramites: [],
	    url: this.route,
	    columns: ['id','tipo','remitente','referencia','entity_id','estado_id','category_id','created_at'],
	    options: {
	        filterByColumn: true,
	        perPage: 10,
	        perPageValues: [10,25,50,100,500],
	        headings: {
	        id: 'ID',
	        tipo: this.labels.tipo,
          remitente: this.labels.remitente,
	        referencia: this.labels.referencia,
	        entity_id: this.labels.entity_id,
	        estado_id: this.labels.estado_id,
	        category_id: this.labels.category_id,
          created_at: this.labels.created_at
	        },
	      customFilters: ['tipo'],
		    sortable: ['id'],
		    filterable: ['tipo','remitente','referencia'],
		    requestFunction(data){
	          return axios.get(this.url,{
	            params: data
	          })
	          .catch(e => {
	            this.dispatch('error',e)
	          });
		    },
        // EDITABLE TEXT OPTIONS:
        texts: {
            count: "Mostrando {from} hasta {to} de {count} registros|{count} registros|Un registro",
            first: 'Primero',
            last: 'Ultimo',
            filter: "Filtro:",
            filterPlaceholder: "Search query",
            limit: "Registros:",
            page: "Pagina:",
            noResults: "Ningun registro encontrado",
            filterBy: "Filtrar por {column}",
            loading: 'Cargando...',
            defaultOption: 'Select {column}',
            columns: 'Columnas'
        }
	    }

	  }
	},
	methods: {
	    filterByTipo(){
	    let vm = this
         Event.$emit('vue-tables.filter::tipo', vm.tipo);
	    },
	    fetchtipostramites(){
          axios.get('/api/tipostramites')
            .then(response => {
            this.tipostramites = response.data;
            })
            .catch(function (error) {
            // handle error
            console.log(error);
            })
            .finally(function () {
            // always executed
            });
        }
	}
}
</script>
<style scoped>
 .table-bordered>thead>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>tfoot>tr>td {
   text-align: center !important;
 }
</style>

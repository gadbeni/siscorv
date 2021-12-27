<template>
    <div class="container col-md-10 col-md-offset-1">
        <div class="input-group mt-5 input-group-lg">
            <input v-model="search" type="text" class="form-control" :placeholder="textplaceholder" aria-label="" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
                <button @click="getDatos" class="btn btn-success" style="height: 50px"><span class="sm-hide">Buscar</span> <span class="bi bi-search label-search"></span></button>
            </div>
        </div>
        <p style="margin: 10px">{{ msg }}</p>
        <div>
            <div class="text-center"  v-if="cont < 1">
                <h4>Descarga los reguisitos aqui.</h4>
                <a href="assets/REQUISITOSPERSONERIAJURIDICA.pdf" class="btn btn-primary" target="_blank">Descargar</a>
            </div>
            <ol>
                <li v-for="todo in datos" :key="todo.id">
                    <span class="text-success">{{ todo.razon_social }}</span>  
                    <strong> PROVINCIA: </strong> {{ todo.provincia }}
                    <strong> MUNICIPIO: </strong> {{ todo.municipio }}
                    <strong> LOCALIDAD: </strong> {{ todo.localidad }}
                </li>
            </ol>
        </div>
    </div>
</template>
<script>
export default {
    name: 'personeria',
    data() {
        return {
            search: '',
            textplaceholder: 'Introduzca el nombre a buscar',
            datos: [],
            msg: '',
             cont : 1,
        }
    },
    methods: {
        async getDatos() {
            try{
                const response = await axios.get('/consultas?search='+this.search);
                let res = response.data;
                this.datos = res.data;
                this.msg = res.message;
                this.cont = res.cont;
              
            } catch (error) {
                console.error(error);
            }
        },
    }
}
</script>
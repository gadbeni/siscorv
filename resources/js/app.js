require('./bootstrap');

import {ServerTable} from 'vue-tables-2';

import Vue from 'vue'

Vue.use(ServerTable, {}, false , 'bootstrap3', 'default');
Vue.component('tramites', require('./components/tramites.vue').default);


const app = new Vue({
    el: '#tramite',
});
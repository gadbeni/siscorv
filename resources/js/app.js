require('./bootstrap');

import {ServerTable} from 'vue-tables-2';

import Vue from 'vue'
import router from './router'

Vue.use(ServerTable, {}, false , 'bootstrap3', 'default');


const app = new Vue({
    router,
    el: '#tramite',
});
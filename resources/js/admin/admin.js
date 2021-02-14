import Vue from 'vue';
import Index from "./components/Index";

import store from './store/index';

import router from "./router";

import './antdRegistration';

import './stylesOverride.css'


const app = new Vue({
    el: "#app",
    render: h => h(Index),
    store,
    router
});




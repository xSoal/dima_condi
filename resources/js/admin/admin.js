import Vue from 'vue';
import Index from "./components/Index";

import store from './store/index';

import router from "./router";

import './antdRegistration';

import './stylesOverride.css'

import variables from "./variables";

import wysiwyg from "vue-wysiwyg";
Vue.use(wysiwyg, {
    locale: 'ru'
}); // config is optional. more below



Vue.mixin({
    computed: {
        mainColor: {
            get(){
                return variables.mainColor
            }
        }
    }
});


const app = new Vue({
    el: "#app",
    render: h => h(Index),
    store,
    router
});




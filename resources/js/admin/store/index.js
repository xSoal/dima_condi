import Vue from 'vue';
import Vuex from 'vuex';

import api from '../api';
import pages from './pages'



const API = new api();
Vue.prototype.$API = API;

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        test: 1
    },
    actions: {

    },

    modules: {
        pages
    }
});




export default store;

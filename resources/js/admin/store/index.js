import Vue from 'vue';
import Vuex from 'vuex';

import API from '../api';
import pages from './pages'
import files from './files'
import pages__constructor from "./pages__constructor";


Vue.prototype.$API = API;

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        globalLoading: false,
    },
    actions: {

    },

    modules: {
        pages,
        files,
        pages__constructor
    }
});




export default store;

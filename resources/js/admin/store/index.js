import Vue from 'vue';
import Vuex from 'vuex';

import API from '../api';
import pages from './pages'
import files from './files'
import pages__constructor from "./pages__constructor";
import serviceBlocks from "./serviceBlocks";
import serviceFAQ from './serviceFAQ';
import serviceTables from './serviceTables';

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
        pages__constructor,
        serviceBlocks,
        serviceFAQ,
        serviceTables
    }
});




export default store;

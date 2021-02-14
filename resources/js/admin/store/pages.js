import api from '../api';

const API = new api();
window.api = API;

import axios from 'axios';

export default {
    state: {
        serviceCategories: [],
        services: [],
        selectedCategoryId: null
    },
    getters: {},
    actions: {
        async getServiceCategories(ctx) {
            const data = await API.get('/service_categories');
            ctx.commit('putServiceCats', data.data);
        },
        async getServicesOfCategory(ctx) {
            const catId = ctx.state.selectedCategoryId;

            const data = await API.get(`/service?category=${catId}`);
            ctx.commit('putService', data.data);
        },
        async addService(ctx, {name, slug}) {
            const catId = ctx.state.selectedCategoryId;

            const data = await API.put(`/service`, {
                category_id: catId,
                name,
                slug
            });

            if( data.error ){
                return {
                    error: true,
                    data: data.response.data
                }
            } else {
                ctx.dispatch('getServicesOfCategory');
                return true;
            }


        },
        async deleteService(ctx, serviceId){
            const req = await API.delete(`/service/${serviceId}`);
            ctx.dispatch('getServicesOfCategory');
            return true;
        }
    },
    mutations: {
        putServiceCats(state, data) {
            state.serviceCategories = data;
        },
        putService(state, data) {
            state.services = data;
        }
    }
}

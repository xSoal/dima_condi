import API from '../api';



import axios from 'axios';

export default {
    state: {
        serviceCategories: [],
        services: [],
        selectedCategoryId: null,
        selectedServiceId: null
    },
    getters: {},
    actions: {

        async getSliderData(ctx){

        },

        async updateService(ctx, formData){
            const sId = ctx.state.selectedServiceId;

            const data = await API.put(`/service/${sId}`, {
                ...formData
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

    },
    mutations: {
        putServiceCats(state, data) {
            state.serviceCategories = data;
        },
        putService(state, data) {
            state.services = data;
        },
        selectCategory(state, catId){
            state.selectedCategoryId = catId;
        },
        selectService(state, serviceId){
            state.selectedServiceId = serviceId;
        }
    }
}

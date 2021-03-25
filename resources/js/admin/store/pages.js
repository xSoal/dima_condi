import API from '../api';
import Vue from 'vue';


import axios from 'axios';
import {showError, showSuccess} from "../helpers";

export default {
    state: {
        serviceCategories: [],
        services: [],
        selectedCategoryId: null,
        selectedServiceId: null,

        // TODO избаваиться от использования копии, из-за её необновления,
        //  повсюду искать из services напрямую по selectedServiceId
        selectedService: {},

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
            ctx.commit('putServices', data.data);
        },
        async addService(ctx, {name, slug}) {
            const catId = ctx.state.selectedCategoryId;

            const data = await API.put(`/service`, {
                category_id: catId,
                name,
                slug
            });

            if (data.error) {
                return {
                    error: true,
                    data: data.response.data
                }
            } else {
                ctx.dispatch('getServicesOfCategory');
                return true;
            }


        },
        async deleteService(ctx, serviceId) {
            const req = await API.delete(`/service/${serviceId}`);
            ctx.dispatch('getServicesOfCategory');
            return true;
        },
        // async updateService(ctx, {category_name, slug, title, description}) {
        //     const sId = ctx.state.selectedServiceId;
        //
        //     const data = await API.put(`/service/${sId}`, {
        //         category_name,
        //         slug,
        //         title,
        //         description
        //     });
        //
        //     if (data.error) {
        //         return {
        //             error: true,
        //             data: data.response.data
        //         }
        //     } else {
        //         ctx.dispatch('getServicesOfCategory');
        //         return true;
        //     }
        //
        // },
        selectCategory(ctx, catId) {
            ctx.commit('selectCategory', catId);
            ctx.dispatch('getServicesOfCategory');
            ctx.dispatch('selectService', null);
        },
        selectService(ctx, serviceId) {
            ctx.commit('selectService', serviceId);
        },
        async updateServiceSliderAPI(ctx, {sliderData}) {
            const response  = await API.put(`/slider/${sliderData.id}`, sliderData);
            ctx.dispatch('getServicesOfCategory');
        },
        deleteServiceSliderElement(ctx, {parseJsonSliderData}) {
            // let sliderData = { ...ctx.state.services[ctx.state.services.findIndex(el => el.id === ctx.state.selectedServiceId)].slider };
            //
            // let json = JSON.parse(sliderData.json_data);
            // json.splice(sliderElementIndex, 1);
            //
            // sliderData.json_data = JSON.stringify(json);


            // --------------
            // ctx.state.services[
            //     ctx.state.services.findIndex(el => el.id === ctx.state.selectedServiceId)
            //     ].slider.json_data = JSON.stringify(json);

            // ctx.commit('updateServiceSlider', {
            //     newJsonData: json.length > 0 ? JSON.stringify(json) : null,
            //     serviceId: ctx.state.selectedServiceId
            // });

            let sliderData = {
                ...ctx.state.services.find(el => el.id === ctx.state.selectedServiceId).slider,
                json_data: JSON.stringify(parseJsonSliderData)
            };

            sliderData.json_data =  JSON.stringify(parseJsonSliderData);

            ctx.dispatch('updateServiceSliderAPI', {sliderData} );

        },

        async createSlider(ctx, sliderData){

            let query = `&`;
            for(let key in sliderData){
                query += `${key}=${sliderData[key]}&`;
            }

            const res = await API.get(`/slider/create?${query}`, sliderData);
            if(res.error){

                showError(res.response.data.message);
            } else {
                showSuccess('Слайдер создан');
            }

            ctx.dispatch('getServicesOfCategory');

            return res.error;
        },

        async addSliderEl(ctx, jsonToAdd){
            const service = ctx.state.services.find(el => el.id === ctx.state.selectedServiceId);
            let sliderData = {...service.slider};


            sliderData.json_data = JSON.stringify([
                ...JSON.parse(sliderData.json_data),
                ...JSON.parse(jsonToAdd)
            ]);

            ctx.dispatch('updateServiceSliderAPI', {sliderData} );

        },

        async deactivateSlider( ctx ){
            const sliderId = ctx.state.selectedService.slider.id;
            await API.post(`/slider_deactivate/${sliderId}`);
            ctx.dispatch('getServicesOfCategory');
        },


        async activateSlider( ctx ){
            const sliderId = ctx.state.selectedService.slider.id;
            await API.post(`/slider_activate/${sliderId}`);
            ctx.dispatch('getServicesOfCategory');
        }

    },
    mutations: {
        putServiceCats(state, data) {
            state.serviceCategories = data;
        },
        putServices(state, data) {
            state.services = data;
        },
        selectCategory(state, catId) {
            state.selectedCategoryId = catId;
        },
        selectService(state, serviceId) {
            state.selectedServiceId = serviceId;
            state.selectedService = state.services.find(el => el.id === serviceId) ?? null;

        },

        updateServiceSlider(state, {newJsonData, serviceId}) {

        }

    }
}

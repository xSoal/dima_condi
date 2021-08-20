
import API from '../api';



export default {
    state: {
        serviceFAQ: null,
    },
    actions: {

        async addFAQ (ctx){
            const serviceId = ctx.rootState.pages.selectedServiceId;

            const res = await API.put(`/service_faq/${serviceId}`, {
                serviceId
            });
            ctx.dispatch('getFAQ');
        },


        async getFAQ (ctx){
            const serviceId = ctx.rootState.pages.selectedServiceId;

            const res = await API.get(`/service_faq/${serviceId}`);
            if(!res.error){
                ctx.commit('putFAQ', res.data);
            }

        },


        async deleteFAQ (ctx, faqID){
            const res = await API.delete(`/service_faq/${faqID}`);
            ctx.dispatch('getFAQ');
        },

        async saveFAQ(ctx, data){
            const res = await API.post(`/service_faq/${data.id}`, data)
        }

    },
    mutations: {
        putFAQ(state, res){
            state.serviceFAQ = res;
        }
    }
}

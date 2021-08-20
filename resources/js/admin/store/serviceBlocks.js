
import API from '../api';



export default {
    state: {
        serviceBlocksData: null,
    },
    actions: {
        async getServiceBlocks(ctx, serviceId){
            const serviceBlocks = ctx.rootState.pages.selectedService.service_block;

            // if(isIssetBlocksInService){
            //     const res = await API.get(`/service_block_by_service/${serviceId}`);
            //     ctx.commit('putServiceBlocks', res.data ?? null);
            // } else {
            //     ctx.commit('putServiceBlocks', null);
            // }

            ctx.commit('putServiceBlocks', serviceBlocks ?? null);
        },

        async setServiceBlocksStatus(ctx, status){
            const res = await API.post(`/service_block_set_active_status/${ctx.state.serviceBlocksData.id}`, {
                is_active: status
            });

            if(!res.error){
                ctx.commit('changeStatus', status);
            }
            return !res.error;

        },

        async deleteServiceBlockChildElement(ctx, blockBlockId){
            const res = await API.delete(`/service_block_block/${blockBlockId}`);
            ctx.dispatch('getServiceBlocks', ctx.state.serviceBlocksData.service_id);
        },


        async createServiceBlock(ctx, serviceId){
            const res = await  API.put(`/service_block/${serviceId}`);

            ctx.dispatch('getServiceBlocks', serviceId);
        },

        async deleteServiceBlock(ctx){
            const res = await  API.delete(`/service_block/${ctx.state.serviceBlocksData.id}`);

            ctx.dispatch('getServiceBlocks', ctx.state.serviceBlocksData.service_id);
        },


        async addServiceBlockElement(ctx){
            const res = await  API.put(`/service_block_block`, {
                serviceBlockId: ctx.state.serviceBlocksData.id
            });

            ctx.dispatch('getServiceBlocks', ctx.state.serviceBlocksData.service_id);
        },


        async saveAllServiceBlockData(ctx){
            const res = await API.post('/service_block_block', ctx.state.serviceBlocksData);
        }

    },
    mutations: {
        putServiceBlocks(state, res){
            state.serviceBlocksData = res;
        },
        changeStatus(state, status) {
            state.serviceBlocksData.is_active = status;
        },
        // deleteServiceBlockBlock(state, blockBlockId){
        //     const index = state.serviceBlocksData.service_block___block.findIndex(el => el.id === blockBlockId);
        //     state.serviceBlocksData.service_block___block.splice(index, 1);
        // }
    }
}


import API from '../api';


export default {
    namespaced: true,
    state: {
        features: null,
    },
    actions: {

        async get(ctx){
            const res = await API.get(`/features/`);
            ctx.commit('putFeatures', res.data ?? null);
        },

        async remove(ctx, id){
            const res = await API.delete(`/features/${id}`);
            ctx.dispatch('get');
        },

        async add(ctx){

            const res = await  API.put(`/features`);
            ctx.dispatch('get');
        },

        async save(ctx, obj){
            const res = await API.post('/features', obj);
            ctx.dispatch('get');
        }

    },
    mutations: {
        putFeatures(state, res){
            state.features = res;
        },

        // deleteServiceBlockBlock(state, blockBlockId){
        //     const index = state.serviceBlocksData.service_block___block.findIndex(el => el.id === blockBlockId);
        //     state.serviceBlocksData.service_block___block.splice(index, 1);
        // }
    }
}

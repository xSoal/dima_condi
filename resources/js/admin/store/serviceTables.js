
import API from '../api';



export default {
    state: {
        tablesData: null,

    },
    actions: {

        async getTables(ctx){
            const serviceId = ctx.rootState.pages.selectedServiceId;
            const res = await API.get(`/service_table/${serviceId}`);

            if(!res.error){
                ctx.commit('putTables', res.data);
            }
        },

        async deleteTable(ctx, tableId){
            const res = await API.delete(`/service_table/${tableId}`);

            if(!res.error){
                ctx.dispatch('getTables');
            }

        },


        async addTable(ctx){
            const serviceId = ctx.rootState.pages.selectedServiceId;
            const res = await API.put(`/service_table`, {
                service_id: serviceId,
                type: 1
            });

            if(!res.error){
                ctx.dispatch('getTables');
            }
        },


        async editTable(ctx, id){
            const table = ctx.state.tablesData.find(table => table.id === id);

            const res = await API.post(`/service_table`, {
                ...table,
                data: JSON.stringify(table.data)

            });
        },

    },
    mutations: {
        putTables(state, data){
            let id = 0;
            state.tablesData = data;
            state.tablesData = state.tablesData.map(el => {
                let data = JSON.parse(el.data);
                data = data.rows ? data : {
                    _rowsCount: 1,
                    _max_id: 1,
                    rows: [
                        [{
                            // column: 1,
                            text: 'Текст',
                            id: 1
                        }]
                    ]
                };
                return { ...el, data }
            });




        }
    }
}

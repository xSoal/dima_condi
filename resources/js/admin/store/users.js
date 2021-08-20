import API from '../api';


export default {
    namespaced: true,
    state: {
        users: [],
    },
    actions: {

        async getUsers(ctx) {

            try {
                const res = await API.get('/users');
                ctx.state.users = res.data;
            } catch (err) {

            }

        },
        async addUser(ctx, newUser) {
            const res = await API.put('/users', newUser);

            if(!res.error){
                ctx.dispatch('getUsers');
                return true;
            }

        },
        async deleteUser(ctx, userId){
            const res = await API.delete(`/users/${userId}`);
            if(!res.error){
                ctx.dispatch('getUsers')
            }
        },
        async editUser(ctx, userId){
            const res = await API.delete(`/users/${userId}`);
            if(!res.error){
                ctx.dispatch('getUsers')
            }
        }




    },
    mutations: {}
}

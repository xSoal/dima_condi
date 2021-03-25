
import API from '../api';


export default {
    state: {

    },
    actions: {
        async loadFileList(){
            const data = await API.get('/images');
            return data.data;
        },
    },
    mutations: {

    }
}

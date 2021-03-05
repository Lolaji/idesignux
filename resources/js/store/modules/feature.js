
import axios from 'axios';

export default {
    namespaced: true,
    state: () => ({}),
    mutations: {},
    getters: {},
    actions: {
        save({ commit }, { id, input })
        {
            let query = !_.isNil(id) ? `/${id}` : '';
            
            return new Promise((resolve, reject) => {
                axios.post(`/api/portfolios${query}`, input).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        remove({ commit }, id) 
        {
            return new Promise((resolve, reject) => { 
                axios.delete(`/api/features/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    }
}
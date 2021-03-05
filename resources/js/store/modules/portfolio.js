
import axios from 'axios';
import metadata from './metadata';

export default {
    namespaced: true,
    modules: {
        metadata
    },
    state: () => ({
        portfolios: [],
        portfolio: null
    }),
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
        fetch({ commit }, query)
        {
            return new Promise((resolve, reject) => {
                axios.get('/api/portfolios', {
                    params: query
                }).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        },
        feature({ commit }, id) {
            return new Promise((resolve, reject) => {
                axios.post(`/api/portfolios/${id}/feature`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        },
        remove({ commit }, id) 
        {
            return new Promise((resolve, reject) => { 
                axios.delete(`/api/portfolios/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    }
}
import axios from "axios";
import { reject } from "lodash";

export default {
    namespaced: true,
    state: () => ({
        metadatas: [],
        metadata: null,
    }),
    mutations: {},
    getters: {},
    actions: {
        save({ commit, rootState }, { id, model, input })
        {
            let query = !_.isNil(input.id) ? `/${input.id}` : '';
            let endpoint = `/api/${model}/${id}/metadatas${query}`;
            
            return new Promise((resolve, reject) => {
                axios.post(endpoint, input).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        remove({ commit }, id) 
        {
            return new Promise((resolve, reject) => { 
                axios.delete(`/api/metadata/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    }
}
import axios from "axios";

export default {
    namespaced: true,
    state: () => ({}),
    mutations: {},
    getters: {},
    actions: {
        delsert({ commit }, input) {
            return new Promise((resolve, reject) => {
                axios.post(`/api/explorer`, input)
                    .then(res => resolve(res.data))
                    .catch(err => reject(err));
            });
        },
        fetch({ commit }, path) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/explorer`, {
                    params: {
                        path: path
                    }
                })
                    .then(res => resolve(res.data))
                    .catch(err => reject(err));
            });
        }
    }
}
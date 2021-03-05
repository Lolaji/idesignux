
import metadata from './metadata';

export default {
    namespaced: true,
    modules: {
        metadata
    },
    state: () => ({
        posts: [],
        post: null
    }),
    mutations: {},
    getters: {},
    actions: {
        save({ commit, rootState }, { user_id, input })
        {
            let query = !_.isNil(input.id) ? `/${input.id}` : '';
            
            return new Promise((resolve, reject) => {
                axios.post(`/api/users/${user_id}/posts${query}`, input).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        remove({ commit }, id) 
        {
            return new Promise((resolve, reject) => { 
                axios.delete(`/api/posts/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    }
}
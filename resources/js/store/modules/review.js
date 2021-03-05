
export default {
    namespaced: true,
    state: () => ({}),
    mutations: {},
    getters: {},
    actions: {
        save({ commit }, input)
        {
            let query = !_.isNil(input.id) ? `/${input.id}` : '';
            
            return new Promise((resolve, reject) => {
                axios.post(`/api/reviews/${query}`, input).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        remove({ commit }, id) 
        {
            return new Promise((resolve, reject) => { 
                axios.delete(`/api/reviews/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    }
}
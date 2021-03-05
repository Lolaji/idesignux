
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
                axios.post(`/api/mailing_list${query}`, input).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        remove({ commit }, id) 
        {
            return new Promise((resolve, reject) => { 
                axios.delete(`/api/mailing_list/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    }
}
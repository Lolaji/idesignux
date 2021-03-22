
export default {
    namespaced: true,
    state: () => ({
        contacts: [],
        contact: null,
        unread: [],
    }),
    mutations: {
        SET_UNREAD(state, unread) {
            state.unread = unread;
        }
    },
    getters: {
        unread: (state) => state.unread,
    },
    actions: {
        save({ commit }, {id, input})
        {
            return new Promise((resolve, reject) => {
                axios.post(`/api/contacts`, input).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        get({ commit }, query) {
            
            return new Promise((resolve, reject) => {
                axios.get('/api/contacts', {
                    params: query
                }).then(res => {
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
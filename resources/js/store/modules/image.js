
export default {
    namespaced: true,
    state: () => ({}),
    mutations: {},
    getters: {},
    actions: {
        remove({ commit }, id) {
            return new Promise((resolve, reject) => {
                axios.delete(`/api/images/${id}`)
                    .then(res => resolve(res.data))
                    .catch(err => reject(err));
            });
        }
    }
}
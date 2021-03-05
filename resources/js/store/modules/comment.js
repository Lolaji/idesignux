
export default {
    namespaced: true,
    state: () => ({
        comments: [],
    }),
    mutations: {},
    getters: {},
    actions: {
        save({ commit }, {postId, commentId, input})
        {
            let query = (!_.isNil(commentId)) ? `/${commentId}` : '';
            return new Promise((resolve, reject) => {
                axios.post(`/api/posts/${postId}/comments${query}`, input).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        remove({ commit }, id) 
        {
            return new Promise((resolve, reject) => { 
                axios.delete(`/api/comments/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    }
}
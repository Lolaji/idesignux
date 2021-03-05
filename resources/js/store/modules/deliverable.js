
export default {
    namespaced: true,
    actions: {
        save({ commit }, { service_id, input })
        {
            let query = !_.isNil(input.id) ? `/${input.id}` : '';
            
            return new Promise((resolve, reject) => {
                axios.post(`/api/services/${service_id}/deliverables${query}`, input).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        remove({ commit }, id) 
        {
            return new Promise((resolve, reject) => { 
                axios.delete(`/api/deliverables/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                });
            });
        }
    }
}
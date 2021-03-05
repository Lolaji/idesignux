import axios from "axios";

import metadata from './metadata';
import subservice from './subservice';
import milestone from './milestone';
import process from './process';
import deliverable from './deliverable';

export default {
    namespaced: true,
    modules: {
        metadata,
        subservice,
        milestone,
        process,
        deliverable
    },
    state: () => ({
        all: [],
        one: null,
        navigation: [],
    }),
    mutations: {
        SET(state, services) {
            state.all = services;
        },
        SET_NAV(state, navs) {
            state.navigation = navs;
        }
    },
    getters: {
        all: state => state.all,
        navigation: state => state.navigation,
    },
    actions: {
        async initStore({ commit, dispatch }) {
            await dispatch('navigation');
        },
        async navigation({ commit }) {
            try {
                let navigation = await axios.get('/api/services/navigation');
                console.log(navigation.data);
                commit('SET_NAV', await navigation.data);
            } catch (error) {
                console.log(error)
            }
        },
        save({ commit }, { service_id, input }) {
            let query = !_.isNil(input.id) ? `/${input.id}` : '';
            let config = {};

            if (!_.isNil(service_id)) {
                config.params = {service_id: service_id}
            }
            
            return new Promise((resolve, reject) => {
                axios.post(`/api/services${query}`, input, config).then(res => {
                    resolve(res.data);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        deattach({ commit }, {service_id, relationship, input}) {
            return new Promise((resolve, reject) => {
                axios.patch(`/api/services/${service_id}/relationship/${relationship}`, input)
                    .then(res => resolve(res.data))
                    .catch(err => reject(err));
            });
        },
        get({ commit, getters }, field) {
            let service = getters['service/services'];
        },
        remove({ commit }, id) {
            return new Promise((resolve, reject) => {
                axios.delete(`/api/services/${id}`).then(res => {
                    resolve(res.data);
                }).catch(err => {
                    reject(err);
                })
            });
        }
    }
}
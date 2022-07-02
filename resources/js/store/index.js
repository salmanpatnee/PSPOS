import Vue from 'vue';
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        authenticated: false,
        user: null,
        // accessToken: null
    },
    getters: {
        authenticated: state => {
            return state.authenticated;
        },
        user: state => {
            return state.user;
        },
        // accessToken: state => {
        //     return state.accessToken;
        // },
    },
    mutations: {
        setAuthenticated: (state, payload) => {
            state.authenticated = payload;
        },
        setUser: (state, payload) => {
            state.user = payload;
        },
        // setAccessToken: (state, payload) => {
        //     state.accessToken = payload;
        // }
    },
    actions: {
        async login({ dispatch }, payload) {
            try {
                axios.get('/sanctum/csrf-cookie');

                const response = await axios.post('/api/login', payload);

                if (response.data.status_code != 200) {
                    throw response.data.message;
                }

                return this.dispatch('getUser');

            } catch (error) {
                throw error;
            }
        },
        async getUser({ commit }) {

            await axios.get('/api/user')
                .then(response => {
                    console.log(response);
                    commit('setUser', response.data);
                    commit('setAuthenticated', true);
                    // commit('setAccessToken', payload.access_token);
                })
                .catch(error => {
                    console.log(error);
                    commit('setUser', null);
                    commit('setAuthenticated', false);
                    // commit('setAccessToken', null);
                })
        },
        async logout({ commit }) {
            await axios.post('/api/logout')
                .then(response => {
                    commit('setUser', null);
                    commit('setAuthenticated', false);
                    // commit('setAccessToken', null);

                })
                .catch(error => {

                    commit('setUser', null);
                    commit('setAuthenticated', false);
                    // commit('setAccessToken', null);
                })
        }
    }
});


export default store;
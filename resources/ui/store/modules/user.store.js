/* jshint esversion: 9 */

import {getUser } from "@ui/http/user.api";

const state = {
    user: {}
};

const getters = {};

const actions = {
    loadUser: async ({commit}) => {
        try {
            const {status, data, statusText} = await getUser();
            if (status !== 200) throw new Error(statusText);
            commit("SET_USER", data );
        } catch (error) {

        }
    }
};

const mutations = {
    SET_USER: (state, user) => state.user = user
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

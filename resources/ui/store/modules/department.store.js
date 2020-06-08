/* jshint esversion: 9 */

import {getDepartments} from "@ui/http/department.api";

const state = {
    departments: []
};

const getters = {};

const actions = {
    loadDepartments: async ({commit}) => {
        try {
            const {status, data, statusText} = await getDepartments();
            if(status !== 200) throw new Error(statusText);
            commit("SET_DEPARTMENTS", data);
        } catch (error) {
            console.log(error);
        }
    },
    addDepartment: ({commit}, department) => {
        commit("ADD_DEPARTMENT", department);
    },
    updateDepartment: ({commit}, department) => {
        commit("UPDATE_DEPARTMENT", department);
    },
    deleteDepartment: ({commit}, id) => {
        commit("DELETE_DEPARTMENT", id);
    }
};

const mutations = {
    SET_DEPARTMENTS: (state, departments) => state.departments = departments,
    ADD_DEPARTMENT: (state, department) => state.departments.push(department),
    UPDATE_DEPARTMENT: (state, updated) => {
        state.departments = state.departments.map(department => {
            if(updated.id === department.id) return updated;
            return department;
        });
    },
    DELETE_DEPARTMENT: (state, id) => {
        state.departments = state.departments.filter(department => department.id !== id);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

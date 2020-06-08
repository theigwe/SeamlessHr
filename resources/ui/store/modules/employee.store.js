/* jshint esversion: 9 */

import {getEmployees} from "@ui/http/employee.api";

const state = {
    employees: []
};

const getters = {};

const actions = {
    loadEmployees: async ({commit}) => {
        try {
            const {status, data, statusText} = await getEmployees();
            if (status !== 200) throw new Error(statusText);
            commit("SET_EMPLOYEES", data);
        } catch (error) {
            console.log(error);
        }
    },
    addEmployee: ({commit}, employee) => {
        commit("ADD_EMPLOYEE", employee);
    },
    updateEmployee: ({commit}, employee) => {
        commit("UPDATE_EMPLOYEE", employee);
    },
    deleteEmployee: ({commit}, id) => {
        commit("DELETE_EMPLOYEE", id);
    }
};

const mutations = {
    SET_EMPLOYEES: (state, employees) => state.employees = employees,
    ADD_EMPLOYEE: (state, employee) => state.employees.push(employee),
    UPDATE_EMPLOYEE: (state, updated) => {
        state.employees = state.employees.map(employee => {
            if(employee.id == updated.id) return updated;
            return employee;
        });
    },
    DELETE_EMPLOYEE: (state, id) => {
        state.employees = state.employees.filter(employee => employee.id !== id);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

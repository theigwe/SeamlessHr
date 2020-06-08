/* jshint esversion: 9 */

import client from "./client";

const PATH = "/api/departments"

const getDepartments = () => client.get(PATH);

const createDepartment = data => client.post(PATH, data);

const updateDepartment = (id, data) => client.put(`${PATH}/${id}`, data);

const deleteDepartment = id => client.delete(`${PATH}/${id}`);

export {getDepartments, createDepartment, updateDepartment, deleteDepartment}

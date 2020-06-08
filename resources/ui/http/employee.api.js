/* jshint esversion: 9 */

import client from "./client";

const PATH = "/api/employees"

const getEmployees = () => client.get(PATH);

const createEmployee = data => client.post(PATH, data);

const updateEmployee = (id, data) => client.put(`${PATH}/${id}`, data);

const deleteEmployee = id => client.delete(`${PATH}/${id}`);

export {getEmployees, createEmployee, updateEmployee, deleteEmployee}

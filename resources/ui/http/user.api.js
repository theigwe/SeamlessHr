/* jshint esversion: 9 */

import client from "./client";

const getUser = () => client.get("user");

const logoutUser = () => client.post("logout");

export {
    getUser, logoutUser
}

/* jshint esversion: 9 */
import VueRouter from "vue-router";

import App from "@ui/layouts/App";
import Dashboard from "@ui/views/Dashboard";

const router = new VueRouter({
    routes: [
        {
            path: "/",
            component: App,
            children: [
                {
                    path: "",
                    name: "dashboard",
                    component: Dashboard
                }
            ]
        }
    ],
    linkActiveClass: "active",
    linkExactActiveClass: "current-active"
});

export default router;

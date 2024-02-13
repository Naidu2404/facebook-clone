import { createRouter, createWebHistory } from "vue-router";
import Start from "./views/Start.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Start,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

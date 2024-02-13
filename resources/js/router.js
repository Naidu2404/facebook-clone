import { createRouter, createWebHistory } from "vue-router";
import NewsFeed from "./views/NewsFeed.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: NewsFeed,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

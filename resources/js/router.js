import { createRouter, createWebHistory } from "vue-router";
import NewsFeed from "./views/NewsFeed.vue";
import UserShow from "./views/Users/Show.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: NewsFeed,
    },
    {
        path: "/users/:userId",
        name: "user.show",
        component: UserShow,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;

import { createApp } from "vue";
import { createStore } from "vuex";
import User from "./modules/user";
import Title from "./modules/title";
import Profile from "./modules/profile";
import Posts from "./modules/posts";

const store = createStore({
    modules: {
        User,
        Title,
        Profile,
        Posts,
    },
});

export default store;

import "./bootstrap";
import { createApp } from "vue";
import router from "./router";
import store from "./store";
import App from "./components/App.vue";

const app = createApp({});

app.use(router);
app.use(store);

app.component("App", App);

app.mount("#app");

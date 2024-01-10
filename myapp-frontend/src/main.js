import { createApp } from "vue";
import { createPinia } from "pinia";
import "./style.css";
import App from "./App.vue";
import axios from "axios";
import VueGoodTablePlugin from "vue-good-table-next";
import "vue-good-table-next/dist/vue-good-table-next.css";

export const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(VueGoodTablePlugin);
axios.defaults.baseURL = "http://127.0.0.1:8000/api";
axios.defaults.withCredentials = true;
app.config.globalProperties.$axios = axios;
app.mount("#app");

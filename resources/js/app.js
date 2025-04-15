import './bootstrap';

import { createApp } from 'vue';
import app from './layouts/app.vue';
import vuetify from "./vuetify";
import router from './router/router.js';
//import '@mdi/font/css/materialdesignicons.css'; // Opcjonalnie, dla ikon
import 'vuetify/styles'; // Ważne dla stylów Vuetify


createApp(app).use(vuetify).use(router).mount("#app");

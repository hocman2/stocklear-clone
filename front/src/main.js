import './style.css';
import './axios.config.js';

import { createApp } from 'vue';
import { createRouter, createWebHashHistory } from 'vue-router';

import App from './App.vue';
import Home from './routes/Home.vue';
import Test from './routes/Test.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/test', component: Test }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

const app = createApp(App);
app.use(router);
app.mount("#app");

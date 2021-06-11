import Vue from 'vue'
import VueRouter from 'vue-router'

// Load components and Pages
import Home from "../components/Home.vue"

Vue.use(VueRouter);

const routes = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Home, name: "home"},
    ]
});

export default routes;
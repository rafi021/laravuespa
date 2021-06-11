import Vue from 'vue'
import VueRouter from 'vue-router'

// Load components and Pages
import Home from "../pages/home.vue"
import CategoryIndex from '../pages/Category/index.vue'
import CategoryCreate from '../pages/Category/create.vue'
import CategoryEdit from '../pages/Category/edit.vue'

Vue.use(VueRouter);

const routes = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Home, name: "home"},

        // Category routes
        { path: '/category', component: CategoryIndex, name: "category-index" },
        { path: '/category/create', component: CategoryCreate, name: "category-create" },
        { path: '/category/edit', component: CategoryEdit, name: "category-edit" },
    ]
});

export default routes;
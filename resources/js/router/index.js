import Vue from 'vue'
import VueRouter from 'vue-router'

// Load components and Pages
import Home from "../pages/home.vue"
import CategoryIndex from '../pages/Category/index.vue'
import CategoryCreate from '../pages/Category/create.vue'
import CategoryEdit from '../pages/Category/edit.vue'

// Authentication file
import Login from "../pages/auth/Login.vue"
import Register from "../pages/auth/Register.vue"
import Dashboard from "../pages/Dashboard/index.vue"

Vue.use(VueRouter);

const routes = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Home, name: "home"},
        { path: '/dashboard', component: Dashboard, name: "dashboard"},

        // Auth routes
        { path: '/auth/login', component: Login, name: "login"},
        { path: '/register', component: Register, name: "register"},

        // Category routes
        { path: '/category', component: CategoryIndex, name: "category-index" },
        { path: '/category/create', component: CategoryCreate, name: "category-create" },
        { path: '/category/edit/:id', component: CategoryEdit, name: "category-edit" }, // this thing can be done with slug
    ]
});

export default routes;
import Vue from 'vue'
import VueRouter from 'vue-router'

// Load components and Pages
// Authentication file
import Login from "../pages/auth/Login.vue"
import Register from "../pages/auth/Register.vue"
import Dashboard from "../pages/Dashboard/index.vue"
import Home from "../pages/home.vue"

import CategoryIndex  from "../pages/Category/Index.vue"
import CategoryStore  from "../pages/Category/Create.vue"
import CategoryEdit  from "../pages/Category/Edit.vue"

import SubCategoryIndex  from "../pages/SubCategory/Index.vue"
import SubCategoryStore  from "../pages/SubCategory/Create.vue"
import SubCategoryEdit  from "../pages/SubCategory/Edit.vue"

import ProductIndex  from "../pages/Product/Index.vue"
import ProductStore  from "../pages/Product/Create.vue"
import ProductEdit  from "../pages/Product/Edit.vue"



Vue.use(VueRouter);

const routes = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Home, name: "home"},
        { path: '/dashboard', component: Dashboard, name: "dashboard", meta: { requiresAuth: true, } },

        // Auth routes
        { path: '/auth/login', component: Login, name: "login",  meta: { requiresVisitor: true, }},
        { path: '/register', component: Register, name: "register"},

        // Category routes
        { path: "/category", name: "category-index", component: CategoryIndex },
        { path: "/store/category", name: "category-create", component: CategoryStore },
        { path: "/edit/category/:id", name: "category-edit", component: CategoryEdit }, // this thing can be done with slug

        // Sub Category routes
        { path: "/sub-categories", name: "subcategory-index", component: SubCategoryIndex },
        { path: "/store/subcategory", name: "subcategory-create", component: SubCategoryStore },
        { path: "/edit/subcategory/:id", name: "subcategory-edit", component: SubCategoryEdit },

        // Product routes
        { path: "/product",name: "products-index",component: ProductIndex },
        { path: "/store/product",name: "products-create",component: ProductStore },
        { path: "/edit/product/:id",name: "products-edit",component: ProductEdit },
    ]
});

export default routes;
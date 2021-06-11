import Vue from 'vue'
// Vue router routes
import routes from './router/index'
require('./bootstrap');

// Vuex store
import store from "./store/index"

// Toastr setup
import CxltToastr from 'cxlt-vue2-toastr'
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css'

var toastrConfigs = {
    position: 'top right',
    showDuration: 1000,
    timeOut: 2000,
    closeButton: true,
    showMethod: 'fadeIn',
    hideMethod: 'faseOut',
}
Vue.use(CxltToastr, toastrConfigs)

// Register vform
// Vue.component(HasError.name, HasError)
// Vue.component(AlertError.name, AlertError)

// Load components globally 
Vue.component('app-header', require('./components/Header.vue').default);

// Vue Router Nagivation Guard
function isLoggedIn() {
    return store.getters.getAuthenticated;
}

//routes middleware 
routes.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    }else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                name: 'dashboard',
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})

// check authentication
let auth = localStorage.getItem("auth");

if(auth){
    store.dispatch('authUser').then(() => {
        const app = new Vue({
            el: '#app',
            router: routes,
            store,
        });
    });
    }
    else {
        const app = new Vue({
            el: '#app',
            router: routes,
            store,
        });
    }

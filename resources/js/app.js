import Vue from 'vue'
import routes from './router/index'
require('./bootstrap');

// Register vform
// Vue.component(HasError.name, HasError)
// Vue.component(AlertError.name, AlertError)

// Load components globally 
Vue.component('app-header', require('./components/Header.vue').default);

const app = new Vue({
    el: '#app',
    router: routes,
});

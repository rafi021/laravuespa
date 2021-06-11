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

const app = new Vue({
    el: '#app',
    router: routes,
    store,
});

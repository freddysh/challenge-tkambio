/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('tipo-cambio-listar-component', require('./components/Admin/TipoCambioListarComponent.vue').default);
Vue.component('tipo-cambio-editar-component', require('./components/Admin/TipoCambioEditarComponent.vue').default);
Vue.component('tipo-cambio-crear-component', require('./components/Admin/TipoCambioCrearComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 import VueGoodTablePlugin from 'vue-good-table';
 // import the styles
 import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);

import moment from 'moment'
import 'moment/locale/es';
Vue.prototype.moment = moment
Vue.use(require('vue-moment'));

// import VeeValidate from 'vee-validate';
// Vue.use(VeeValidate);

import es from 'vee-validate/dist/locale/es'
// Importa VeeValidate y el Validator
import VeeValidate, { Validator } from "vee-validate";
Vue.use(VeeValidate);
// Indicar uso de idioma español
Validator.localize("es", es);

// main.js
import VueSweetalert2 from 'vue-sweetalert2';
// // If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app',
});

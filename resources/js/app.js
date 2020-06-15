
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import {routes} from './routes';
import AdminMain from './components/admin/AdminMaster.vue';

Vue.component('admin-main', AdminMain);

import PublicMain from './components/public/PublicMain.vue';
Vue.component('public-main', PublicMain);

//Vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from './store/index'
const store = new Vuex.Store(
	storeData
)

//DateFormat
import {filter} from './filter'


//editor
// import VueMarkdownEditor from '@kangc/v-md-editor';
// import '@kangc/v-md-editor/lib/style/base-editor.css';
// import vuepressTheme from '@kangc/v-md-editor/lib/theme/vuepress.js';



// VueMarkdownEditor.use(vuepressTheme);

// Vue.use(VueMarkdownEditor);

//V-Form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


//Sweet Alert 2
import swal from 'sweetalert2';
const Swal = require('sweetalert2')
window.swal = swal;



const router = new VueRouter({
	routes,
	mode:'hash',
	base: '/superblog',
	
});


const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})



window.Toast = Toast;
window.swalWithBootstrapButtons = swalWithBootstrapButtons;

const app = new Vue({
	el: '#app',
    router,
    store
});


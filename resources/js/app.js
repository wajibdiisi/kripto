require('./bootstrap');


window.Vue = require('vue');


import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import VueSwal from 'vue-sweetalert2';
import Axios from 'axios';
import Vuelidate from 'vuelidate';
import moment from 'moment';

Vue.use(VueRouter,VueAxios,Axios);
Vue.use(Vuelidate);
Vue.use(VueSwal);

import App from './components/App.vue';
import Home from './components/Home.vue';
import transactionDetail from './components/transaction_detail.vue';
import sendMoney from './components/sendMoney.vue';
import { create } from 'lodash';


Vue.prototype.$http = Axios;
Vue.prototype.$user = window.User;
Vue.filter('formatDate', function(value) {
    if (value) {
      return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
  })


// membuat router
const routes = [
    {
        name: 'home',
        path: '/home',
        component: Home
    },
    {
        name : 'sendMoney',
        path : '/home/send_money',
        component : sendMoney
    },
    {
        name : 'transactionDetail',
        path : '/home/transaction/:transaction_id',
        component : transactionDetail
    },
   
]
new Vue ({
    validations: {}
})

const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");
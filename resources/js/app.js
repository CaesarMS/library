require('./bootstrap');
global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

window.Vue = require('vue');
 
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.config.productionTip = false;

import Vessel from './components/Vessel.vue';

import Member from './components/Member.vue';
import Home from './components/Home.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
 
const routes = [
    {
        name: 'member',
        path: '/member',
        component: Member
    },{
        name: 'home',
        path: '/',
        component: Home
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, Vessel)).$mount('#app');
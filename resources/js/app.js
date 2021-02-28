require('./bootstrap');
global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

window.Vue = require('vue');
 
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import mouseMenu from 'vue-mouse-menu';

Vue.config.productionTip = false;

import Member from './components/Member.vue';
import Home from './components/Home.vue';

import LibraryIndex from './components/LibraryIndex.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(mouseMenu);
 
const routes = [
    {
        name: 'home',
        path: '/',
        component: LibraryIndex
    }
];

const member = new Vue({
    el: '#app',
    render: h => h(Member)
})

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, Home)).$mount('#app-two');
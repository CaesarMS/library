require('./bootstrap');
global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

window.Vue = require('vue');
 
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.config.productionTip = false;

import Member from './components/Member.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
 

const member = new Vue({
    el: '#app',
    render: h => h(Member)
});
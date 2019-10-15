
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import WeVue from 'we-vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
Vue.use(WeVue);
import store from './store/'; // vuex 数据存储所需对象
import routes from './routes';    // 路由配置文件
import Layout from './components/LayoutComponent.vue'

// 实例化路由
const router = new VueRouter({
    routes
});

const app = new Vue({
    el: '#app',
    store,
    router,
    components: { Layout },
    template: '<Layout/>'
});

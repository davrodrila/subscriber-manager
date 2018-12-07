import VueRouter from 'vue-router'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

Vue.component('app', require('./components/App.vue'));
Vue.component('show_subscriber', require('./components/ShowSubscriberComponent.vue'));

import App from './components/App'
import Show_subscriber from './components/ShowSubscriberComponent';
import Delete_subscriber from './components/DeleteSubscriber';
import New_subscriber from './components/NewSubscriber';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: App
        },
        {
            path: '/show/:id',
            name: 'show_subscriber',
            component: Show_subscriber,
        },
        {
            path: '/delete/:id',
            name: 'delete_subscriber',
            component: Delete_subscriber,
        },
        {
            path: 'new',
            name: 'new_subscriber',
            component: New_subscriber
        }

    ]
});

router.beforeEach((to, from, next) => {
    NProgress.start()
    next()
})
router.afterEach(() => {
    NProgress.done()
})
const app = new Vue({
    el: '#app',
    router
});
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./FormErrorHandler');
require('summernote/dist/summernote-bs4.js');
require('./summernote');
require('@fortawesome/fontawesome-free')

const toastr = require('toastr');

window.Toastr = toastr;
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

require('./components/song/upload.js');
require('./components/song/update.js');
Vue.component('vote', require('./components/Vote.vue').default);
Vue.component('Comments', require('./components/Comments.vue').default);
Vue.component('Comment', require('./components/Comment.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

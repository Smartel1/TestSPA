
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
window.Vue.use(VueRouter);


import ArticlesList from './components/ArticlesList.vue';
import ArticleViewer from './components/ArticleViewer.vue';
import ArticleEditor from './components/ArticleEditor.vue';

const router = new VueRouter({
    routes: [
        {path: '/', component: ArticlesList, name: 'list'},
        {path: '/article/create', component: ArticleEditor, name: 'create'},
        {path: '/article/:id', component: ArticleViewer, name: 'article', props: true},
        {path: '/article/:id/edit', component: ArticleEditor, name: 'edit', props: true},
    ]
});
var app = new Vue({
    el: '#app',
    router: router
});

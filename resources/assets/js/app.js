
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
window.Vue.use(VueRouter);


import ArticlesList from './components/ArticlesList.vue'; //список новостей
import ArticleViewer from './components/ArticleViewer.vue'; //просмотр статьи
import ArticleEditor from './components/ArticleEditor.vue'; //редактор статьи

//маршруты
const router = new VueRouter({
    routes: [
        {path: '/', component: ArticlesList, name: 'list'},
        {path: '/article/create', component: ArticleEditor, name: 'create'},
        {path: '/article/:id', component: ArticleViewer, name: 'article', props: true},
        {path: '/article/:id/edit', component: ArticleEditor, name: 'edit', props: true},
    ]
});
new Vue({
    el: '#app',
    router: router
});

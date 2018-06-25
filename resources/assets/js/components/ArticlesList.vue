<template>
    <div>
        <!--                             заголовок                               -->
        <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">Лента новостей</span>
            <router-link :to="{name: 'create'}" tag="button" class="btn btn-light">
                Добавить новость
            </router-link>
        </nav>

        <div class="container">
        <!--                          карты с новостями                         -->
            <div v-for="article in articles" class="card card-default mt-2">
                <div class="card-header clickable" @click="show(article.id)">
                    <h5 class="card-title">{{article.title}}</h5>
                </div>
                <div class="card-body">
                    {{article.body}}
                    <hr>
                    <div class="float-right">
                        <button class="btn btn-link" @click='edit(article.id)'>Редактировать</button>
                        <button class="btn btn-link text-danger" @click='modal_show(article.id)'>Удалить</button>
                    </div>
                 </div>
            </div>

        </div>
        <!--                          модальное окно                         -->
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Вы действительно хотите удалить запись?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" @click="del">Удалить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                articles: [],
                article_to_delete: 0
            }
        },
        methods: {
            show: function (id) {
                this.$router.push({name:'article', params: {id: id}});
            },
            edit: function (id) {
                this.$router.push({name: 'edit', params: {id}});
            },
            modal_show: function(id){
                $('#Modal').modal({});
                this.article_to_delete=id;
            },
            del: function () {
                axios.get('api/article/'+this.article_to_delete+'/delete')
                    .then(response => {
                        this.init();
                    })
            },
            init: function () {
                axios.get('api/articles')
                    .then(response => {
                        //получаем массив статей и сортируем, новые наверх
                        this.articles=response.data;
                        this.articles=this.articles.sort((a, b)=>{return b.id-a.id});
                    })
            }
        },
        //этот хук вызывается для инициализации списка новостей
        beforeRouteEnter(to, from, next) {
            next(vm=>vm.init())
        }
    }
</script>

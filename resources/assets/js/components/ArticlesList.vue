<template>
    <div>
<!--                             заголовок                               -->
        <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">Лента новостей</span>
            <button class="btn btn-light">Добавить новость</button>
        </nav>

        <div class="container">
 <!--                          карты с новостями                         -->
            <div v-for="article in articles" class="card card-default mt-2">
                <div class="card-header">
                    <router-link :to="{name:'article', params: {id: article.id}}">go</router-link>
                    <h5 class="card-title">{{article.title}}
                    </h5>
                </div>
                <div class="card-body">
                    {{article.body}}
                    <hr>
                    <div class="float-right">
                        <a href="#" class="card-link">Редактировать</a>
                        <a href="#" class="card-link">Удалить</a>
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
                articles: []
            }
        },
        mounted() {
            //получаем статьи с сервера
            axios.get('api/articles')
                .then(response => this.articles=response.data)
        }
    }
</script>

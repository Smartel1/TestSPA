<template>
    <div>
<!--                             заголовок                               -->
        <nav class="navbar navbar-dark bg-dark">
                <router-link :to="{name: 'list'}">
                    <button class="btn btn-light">Назад</button>
                </router-link>
            <div>
                <button class="btn btn-light">Редактировать</button>
                <button class="btn btn-light">Удалить</button>
            </div>
        </nav>
<!--                             тело новости                            -->
        <div class="container">
            <h4 class="card-title">{{title}}</h4>
            {{body}}
            <div class="float-right">
               <p class="font-weight-bold">Просмотров: {{visits}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                title: "",
                body: "",
                visits: 0
            }
        },
        props: ['id'],
        beforeRouteEnter(to, from, next) {
            next(vm=>{
                axios.get('api/article/'+vm.id,)
                    .then(response => {
                        vm.title=response.data.title;
                        vm.body=response.data.body;
                        vm.visits=response.data.visits_count;
                    })
            })
        }
    }
</script>

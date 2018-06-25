<template>
    <div>
        <!--                             заголовок                               -->
        <nav class="navbar navbar-dark bg-dark">
            <router-link :to="{name: 'list'}">
                <button class="btn btn-light">Назад</button>
            </router-link>
            <div>
                <button class="btn btn-light" @click="edit(id)">Редактировать</button>
                <button class="btn btn-light" @click="modal_show">Удалить</button>
            </div>
        </nav>
        <!--                             тело новости                            -->
        <div class="container">
            <h4 class="card-title mt-3">{{title}}</h4>
            {{body}}
            <br>
            <div class="float-right mt-2">
               <p class="font-weight-bold">Просмотров: {{visits}}</p>
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
                title: "",
                body: "",
                visits: 0
            }
        },
        methods: {
            edit: function (id) {
                //переходим к редактированию статьи
                this.$router.push({name: 'edit', params: {id}});
            },
            modal_show: function(){
                $('#Modal').modal({});
            },
            del: function () {
                //удаляем статью и возвращаемся "домой"
                axios.get('api/article/'+this.id+'/delete')
                    .then(response => {
                        this.$router.push({name: 'list'});
                    })
                    .catch(function (response) {
                        alert(response.message);
                    })
            },
        },
        props: ['id'],
        beforeRouteEnter(to, from, next) {
            next(vm=>{
                //инициализация данными с сервера
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

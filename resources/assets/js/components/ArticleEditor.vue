<template>
    <div>
        <!--                             заголовок                               -->
        <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">Редактор статей</span>
        </nav>
        <!--                               форма                                 -->
        <div class="container">
            <form action="/api/article/create" id="article_form"
            novalidate
            @submit="submit">
                <div class="form-group mt-3">
                    <input type="text" id="title_field"
                           placeholder="Заголовок" class="form-control"
                           required/>
                    <div class="invalid-feedback">
                        Это обязательное поле!
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="body_field"
                              rows="10" placeholder="Статья"
                              required ></textarea>
                    <div class="invalid-feedback">
                        Это обязательное поле!
                    </div>
                </div>
            </form>
            <div class="float-right">
                <button class="btn btn-primary" @click='submit'>Сохранить</button>
                <button class="btn btn-secondary" @click='cancel'>Отмена</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
            }
        },
        props: ['id'],
        methods:{
            submit: function (e) {
                //оформление валидации
                let article_form = document.getElementById('article_form');
                article_form.classList.add('was-validated');
                //если форма прошла валидацию
                if (article_form.checkValidity()){
                    //вытаскиваем данные формы для AJAX
                    let bodyFormData = new FormData();
                    bodyFormData.set('title', $("#title_field").val());
                    bodyFormData.set('body', $("#body_field").val());
                    let router = this.$router;
                    //выбираем действие для создания/изменения статьи
                    let action = this.id? (this.id+'/edit'):'create';
                    //посылаем запрос
                    axios({
                        method: 'post',
                        url: '/api/article/'+action,
                        data: bodyFormData,
                        config: { headers: {'Content-Type': 'multipart/form-data' }}
                    })  .then(function () {
                        router.push({name: 'list'});
                    })  .catch(function (response) {
                        alert("Произошла ошибка! Ответ сервера: "+response.message);
                    })
                }
                e.preventDefault();
            },
            cancel: function () {
                this.$router.go(-1);
            }
        },
        beforeRouteEnter(to, from, next) {
            next(vm=>{
                //получаем статью с сервера, если задан параметр id
                if (vm.id){
                    axios.get('api/article/'+vm.id)
                        .then(response => {
                            //получаем статью
                            $('#title_field').val(response.data.title);
                            $('#body_field').val(response.data.body);
                        })
                }
            })
        }
    }
</script>

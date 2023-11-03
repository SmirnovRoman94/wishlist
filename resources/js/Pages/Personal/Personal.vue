<template>
    <Head title="Personal" />
    <MainLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Личный кабинет</h2>
            <Link :href="route('dashboard.index')" class="hover:text-sky-400 link">Назад</Link>
        </template>
        <div class="sm:py-12 p-4" ref="myBlock">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3 class="text-lg mb-3">Сменить аватар</h3>
                <div class="flex  items-center">
                    <div class="block w-24 h-24 rounded-full overflow-hidden bg-gray-300">
                        <img :src="avatar" :alt="user.name" class="w-24 h-24 w-full block flex justify-center items-center">
                    </div>
                    <button @click="openModal = true" class="btn ml-5">Загрузить</button>
                </div>
                <div class="mt-5">
                    <h3 class="text-lg mb-3">Дата рождения</h3>
                    <vue-tailwind-datepicker v-model="dateValue" as-single />
                </div>
                <div class="mt-5">
                    <h3 class="text-lg mb-3">Расскажите о себе</h3>
                    <QuillEditor theme="snow" toolbar="minimal" contentType="html" v-model:content="content"/>
                </div>
                <div class="mt-5">
                    <button class="btn" @click="save">Сохранить</button>
                </div>
            </div>

            <PhotoModal v-model:open="openModal" :type="'avatar'" :height="height" @result="resultPhoto"/>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head } from '@inertiajs/vue3';
import { Link } from "@inertiajs/vue3";
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
import { QuillEditor, Delta } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import PhotoModal from "@/Components/PhotoModal.vue";
export default {
    name: "Personal.vue",
    components: {MainLayout, Head, Link, VueTailwindDatepicker, QuillEditor, PhotoModal},
    props: [
        'user'
    ],
    data: () =>({
        dateValue: [],
        avatar: null,
        content: null,

        openModal: false,
        height: null
    }),
    computed: {
      currentDate() {
          let date = null;
          console.log(this.dateValue)
          if(this.dateValue.length > 0){
              let item = this.dateValue[0].split(' ')[0];
              let res = item.split('-');
              date = `${res[2]}.${res[1]}.${res[0]}`
          }
          return date
      }
    },
    methods: {
        resultPhoto(res) {
            this.avatar = res;
            this.openModal = false;
        },
        save() {

            const formData = new FormData()
            formData.append('avatar', this.avatar)
            formData.append('content', this.content)
            formData.append('date', this.currentDate)
            formData.append('_method', 'patch')

            this.$inertia.post('/users/personal', formData);
        }
    },
    mounted() {
        console.log(this.$page.props.auth.user);
        if(this.$page.props.auth.user){
            this.content = this.$page.props.auth.user.about
            this.avatar = this.$page.props.auth.user.avatar;
            if(this.$page.props.auth.user.birthday){
                let items = this.$page.props.auth.user.birthday.split('.');
                var date = new Date();
                let hourse = date.getHours() < 10  ? `0${date.getHours()}` : date.getHours();
                let minutes = date.getMinutes() < 10 ? `0${date.getMinutes()}` : date.getMinutes();
                let secundes = date.getSeconds() < 10 ? `0${date.getSeconds()}` : date.getSeconds();
                let dateTime = `${items[2]}-${items[1]}-${items[0]} ${hourse}:${minutes}:${secundes}`;
                console.log(dateTime);
                this.dateValue[0] = dateTime;


            }
        }
    },
    watch: {
        dateValue: function (){
            console.log(this.dateValue)
        },
        currentDate: function (){
            console.log(this.currentDate)
        }
    }
}
</script>

<style scoped>
img {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    /*padding-top: 35px;*/
}
.btn {
    border: 1px solid #7337de;
    text-align: center;
    padding: 10px 15px;
    color: #fff;
    background-color: #7337de;
    border-radius: 10px;
    transition: .1s;
}
.btn:hover{
    transform: scale(1.1);
}

/*media*/
@media (max-width: 800px) {
    .link{
        font-size: 14px;
    }
    .btn{
        font-size: 16px;
    }
}
</style>

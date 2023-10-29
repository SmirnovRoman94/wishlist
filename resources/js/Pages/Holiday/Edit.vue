<template>
    <Head title="Holiday" />
    <div>
        <MainLayout>
            <template #header>
                <h2 class="font-semibold sm:text-xl text-gray-800 leading-tight text-sm">Редактирование мероприятия</h2>
                <Link :href="route('holiday.show', holidayItem.id )" class="hover:text-sky-400 link">Назад</Link>
            </template>
            <div class="p-4">
                <div>
                    <div class="sm:mb-4 px-2 mb-2">
                        <label class="pb-3 italic text-center block text-gray-400">Название события</label>
                        <input type="text" placeholder="Введитие название праздника" class="input" v-model="title">
                        <div v-if="this.$page.props.errors.title && title.length == 0" class="text-xs text-red-600 pt-2">
                            {{ this.$page.props.errors.title }}
                        </div>
                    </div>
                    <div class="sm:mb-4 px-2 mb-2">
                        <label class="pb-3 italic text-center block text-gray-400">Дата проведения мероприятия</label>
                        <vue-tailwind-datepicker v-model="dateValue" as-single />
                        <div v-if="this.$page.props.errors.date && dateValue.length == 0" class="text-xs text-red-600 pt-2">
                            {{ this.$page.props.errors.date }}
                        </div>
                    </div>
                    <div class="sm:mb-4 px-2 mb-2">
                        <label class="pb-3 italic text-center block text-gray-400">Описание мероприятия</label>
                        <textarea type="text" placeholder="Пожелания, место проведения и другая информация" class="input_text" v-model="description">
                        </textarea>
                    </div>
                    <div class="scroll sm:mb-4 px-2 mb-2">
                        <a href="#" @click.prevent="openModal = true" :class="['block overflow-hidden bg-gray-200 rounded-lg', !image ? 'h-40' : '']">
                            <div v-if="!image" class="flex justify-center items-center h-40">
                                <span class="block italic text-gray-500">Добавить постер мероприятия (желательно горизонтального формата )</span>
                            </div>
                            <img v-else :src="image" alt="Постер мероприятия" class="w-full block">
                        </a>
                    </div>
                </div>
                <div class="sm:mt-4 sm:w-1/2 w-full flex justify-center mx-auto mt-0">
                    <a href="#" class="btn" @click.prevent="update">Изменить</a>
                </div>
                <PhotoModal v-model:open="openModal" :type="'default'" @result="resultPhoto"/>
            </div>
        </MainLayout>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from "@/Layouts/MainLayout.vue";
import {defineComponent} from "vue";
import VueTailwindDatepicker from 'vue-tailwind-datepicker'
import PhotoModal from "@/Components/PhotoModal.vue";

export default defineComponent({
    name: "Create.vue",
    components: {
        MainLayout,
        VueTailwindDatepicker,
        Head,
        Link,
        PhotoModal
    },
    props: ['holidayItem'],
    data(){
        return {
            dateValue: [],
            title: this.$page.props.holidayItem.title,
            description: this.$page.props.holidayItem.description,
            image: this.$page.props.holidayItem.image,

            openModal: false
        }
    },
    computed: {
        currentDate() {
            let date  = null;
            if(this.dateValue.length > 0){
                let item = this.dateValue[0].split(' ')[0];
                let res = item.split('-');
                date = `${res[2]}.${res[1]}.${res[0]}`
            }
            return date
        }
    },
    methods: {
        update() {
            console.log(this.title, this.currentDate, this.description, this.image)
            this.$inertia.patch(`/holiday/${this.holidayItem.id}`, {
                title: this.title,
                date: this.currentDate,
                description: this.description,
                img: this.image
            })
        },
        resultPhoto(res) {
            console.log(res)
            this.image = res;
            this.openModal = false;
        }
    },
     mounted() {
        if(typeof this.$page.props['holidayItem'] !== "undefined"){
            if(this.$page.props.holidayItem.date){
                let items = this.$page.props.holidayItem.date.split('.');
                let date = new Date();
                let hourse = date.getHours() < 10  ? `0${date.getHours()}` : date.getHours();
                let minutes = date.getMinutes() < 10 ? `0${date.getMinutes()}` : date.getMinutes();
                let secundes = date.getSeconds() < 10 ? `0${date.getSeconds()}` : date.getSeconds();
                this.dateValue[0] = `${items[2]}-${items[1]}-${items[0]} ${hourse}:${minutes}:${secundes}`;
            }
        }
     }
});
</script>

<style scoped>
.input {
    border-radius: 10px;
    border: 1px solid #d1d5db;
}
.input_text{
    border-radius: 10px;
    border: 1px solid #d1d5db;
    height: 200px;
}
.btn {
    background: #9b5bde;
    color: white;
    padding: 15px 25px;
    border-radius: 10px;
    display: block;
    text-align: center;
    font-weight: 500;
    font-size: 16px;
    transition: .1s;
    width: 100%;
    cursor: pointer;
}
.btn:hover{
    transform: scale(1.05);
}

.scroll {
    height: 450px;
    overflow: auto;
}

@media (max-width: 640px) {
    label{
        font-size: 14px;
    }
    .input_text{
        height: 100px;
    }
    .scroll{
        height: 180px;
    }
}
</style>

<template>
    <Head title="Holiday" />
    <div>
        <MainLayout>
            <template #header>
                <h2 class="sm:font-semibold sm:text-xl sm:text-gray-800 sm:leading-tight  text-sm">Создание мероприятия</h2>
                <Link :href="route('dashboard.index')" class="hover:text-sky-400 link">Назад</Link>
            </template>
            <div class="sm:p-4 px-4 py-2">
                <div>
                    <div class="sm:mb-4 sm:px-2 mb-0">
                        <label class="sm:pb-3 italic sm:text-center sm:block text-gray-400 text-sm">Название события</label>
                        <input type="text" placeholder="Введитие название праздника" class="input" v-model="title">
                        <div v-if="this.$page.props.errors.title && title.length == 0" class="text-xs text-red-600 pt-2">
                            {{ this.$page.props.errors.title }}
                        </div>
                    </div>
                    <div class="sm:mb-4 sm:px-2 mb-0">
                        <label class="sm:pb-3 italic sm:text-center sm:block text-gray-400 text-sm">Дата проведения мероприятия</label>
                        <vue-tailwind-datepicker v-model="dateValue" as-single />
                        <div v-if="this.$page.props.errors.date && dateValue.length == 0" class="text-xs text-red-600 pt-2">
                            {{ this.$page.props.errors.date }}
                        </div>
                    </div>
                    <div class="sm:mb-4 sm:px-2 mb-0">
                        <label class="sm:pb-3 italic sm:text-center sm:block text-gray-400 text-sm">Описание мероприятия</label>
                        <textarea type="text" placeholder="Пожелания, место проведения и другая информация" class="input_text" v-model="description"></textarea>
                    </div>
                    <div class="scroll sm:mb-4 sm:px-2 mb-0">
                        <a href="#" @click.prevent="openModal = true" :class="['block overflow-hidden bg-gray-200 rounded-lg', !image ? 'grey' : '']">
                            <div v-if="!image" class="flex justify-center items-center p-2">
                                <span class="sm:block italic text-gray-500 text-sm">Добавить постер мероприятия (желательно горизонтального формата )</span>
                            </div>
                            <img v-else :src="image" alt="Постер мероприятия" class="w-full block">
                        </a>
                    </div>
                </div>
                <div class="mt-4 sm:w-1/2 w-full flex justify-center mx-auto">
                    <a href="#" class="btn" @click.prevent="store">Добавить</a>
                </div>
            </div>
            <PhotoModal v-model:open="openModal" :type="'default'" @result="resultPhoto"/>
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
    data: () => ({
        dateValue: [],
        title: '',
        description: '',
        image: null,

        openModal: false
    }),
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
        store() {
            this.$inertia.post('/holiday', {
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
        },
    }
});
</script>

<style scoped>
.input {
    border-radius: 10px;
    border: 1px solid #d1d5db;
}
.input_text{
    height: 200px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
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
    max-height: 450px;
    overflow: auto;
}
.grey{
    height: 10rem;
    text-align: center;
}
@media (max-width: 800px) {
    .link{
        font-size: 14px;
    }
    .grey{
        height: 7rem;
    }
}
@media (max-width: 640px) {
    .input_text{
        height: 70px;
    }
    .grey{
        height: 5rem;
    }
    .btn{
        width: 100%;
    }
}
</style>

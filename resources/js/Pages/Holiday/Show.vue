<template>
    <Head title="Presents" />
    <div>
        <MainLayout>
            <template #header>
                <h2 class="sm:font-semibold sm:text-xl text-gray-800 leading-tight text-sm">Создание списка желаний</h2>
                <Link :href="route('dashboard.index')" class="hover:text-sky-400 link_item">Назад</Link>
            </template>
            <div class="p-4 flex justify-center">
                <div class="flex flex-col w-full relative">
                    <img class="sm:h-[200px] h-[100px] rounded-lg relative" :src="holidayItem.image" :alt="holidayItem.title">
                    <div class="absolute sm:w-full mx-auto">
                        <div class="mb-4 px-2 flex justify-between items-center">
                            <h3 class="text-2xl text-white italic underline">{{holidayItem.title}}</h3>
                            <div class="flex" v-if="holidayItem.user_id === $page.props.auth.user.id">
                                <div class="btn_icon">
                                    <Link :href="route('holiday.edit', holidayItem.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div class="sm:mb-4 px-2 mb-2">
                            <p class="text-lg text-white">Дата проведения: <span class="itelic">{{holidayItem.date}}</span></p>
                        </div>
                    </div>
                    <div class="sm:mb-4 px-2 mb-2">
                        <p class="text-lg text-cyan-600 ">Информация о мероприятии:</p>
                        <p class="pt-1">{{holidayItem.description}}</p>
                    </div>
                    <div class="wish">
                        <h5 class="sm:text-lg text-gray-500 text-center text-sm">Wish list</h5>
                        <div class="mt-2" v-if="holidayItem.user_id === $page.props.auth.user.id">
                            <button class="btn" @click="openPresentModal = true">Добавить подарок</button>
                        </div>
                        <div class="scroll sm:mt-5 mt-2" v-if="listPresents.length > 0">
                            <div v-for="(present, index) in listPresents" :key="present.id" class="item">
                                <a :href="present.url_link" class="link">
                                    <img :src="present.image_url" :alt="present.name" class="img_present">
                                    <div class="desc">
                                        <h3>Наименование:</h3>
                                        <p class="py-3 italic">{{present.name}}</p>
                                        <hr>
                                        <h3 class="py-3" v-if="present.description && present.description.length > 0">Пожелания:</h3>
                                        <p>{{present.description}}</p>
                                    </div>
                                </a>
                                <div class="flex mt-5 justify-between sm:mx-6 pb-2 mx-2" v-if="holidayItem.user_id === $page.props.auth.user.id">
                                    <div>
                                        <button @click.prevent="editPresent(present)"
                                            class="btn_item bg-cyan-400 cursor-pointer inline-flex items-center text-center text-white font-medium px-8 py-4 border border-cyan-400 rounded-lg hover:bg-white hover:text-cyan-400 transition duration-150 ease-out hover:ease-in">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            <span class="pl-2">Изменить</span>
                                        </button>
                                    </div>
                                    <div>
                                        <button @click.prevent="deletePresent(present, index)"
                                            class="btn_item bg-rose-400 cursor-pointer inline-flex items-center text-center text-white font-medium px-8 py-4 border border-rose-400 rounded-lg hover:bg-white hover:text-rose-400 transition duration-150 ease-out hover:ease-in">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            <span class="pl-2">Удалить</span>
                                        </button>
                                    </div>
                                </div>
                                <div v-else class="mt-5 mx-6 pb-2">
                                    <div v-if="present.choose_present == 0" class="flex justify-center">
                                        <button @click.prevent="openAdditing(present)"
                                                class="btn_item bg-cyan-400 cursor-pointer inline-flex items-center text-center text-white font-medium px-8 py-4 border border-cyan-400 rounded-lg hover:bg-white hover:text-cyan-400 transition duration-150 ease-out hover:ease-in">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            <span class="pl-2">Выбрать подарок</span>
                                        </button>
                                    </div>
                                    <div v-if="present.choose_present == 1">
                                        <h3 class="text-red-600 italic text-lg">Данный подарок выбран пользователем, {{$page.props.auth.user.name}} </h3>
                                        <h3 class="my-2 underline">Комментарий пользователя:</h3>
                                        <p class="my-2 italic">{{present.comment}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <PresentModal v-model:open="openPresentModal" :editingItem="itemPresent" @result="resultItem" @update="updateItem"/>
            <AdditingPresentModal v-model:open="openAdditingModal" :editingItem="itemAdditingPresent" @result="addPresent"/>
        </MainLayout>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from "@/Layouts/MainLayout.vue";
import {defineComponent} from "vue";
import PresentModal from "@/Components/PresentModal.vue";
import AdditingPresentModal from "@/Components/AdditingPresentModal.vue";
export default defineComponent({
    name: "Show.vue",
    components: {
        Head,
        MainLayout,
        Link,
        PresentModal,
        AdditingPresentModal
    },
    props: [
        'holidayItem'
    ],
     data() {
        return {
            listPresents: this.$page.props.holidayItem.presents,
            openPresentModal: false,
            itemPresent: null,

            openAdditingModal: false,
            itemAdditingPresent: null
        }
     },
    methods: {
        resultItem(item) {
            this.listPresents.push(item);
            this.openPresentModal = false;
        },
        updateItem(item){
            this.listPresents = this.listPresents.map(el => el.id === item.id ? item : el);
            this.openPresentModal = false;
        },
        editPresent(item) {
            console.log(item)
            this.itemPresent = {
                id: item.id,
                title: item.name,
                description: item.description,
                url: item.url_link,
                imageUrl: item.image_url
            }
            this.openPresentModal = true;
        },
        deletePresent(item, index) {
            axios.delete(`/present/${item.id}`)
                .then(res =>
                    res.data.result === 1
                        ? this.listPresents.splice(index, 1)
                        : console.log(res.data)
                )
        },

        openAdditing(present){
            this.itemAdditingPresent = present;
            this.openAdditingModal = true;

        },
        addPresent(item){
            console.log(item)
            axios.post(`/present/add_present/${item.id}`, {
                'holiday_id': this.$page.props.holidayItem.id,
                'title': item.name,
                'link': item.url_link,
                'description': item.description ?? null,
                'image': item.imageUrl ?? null,
                'comment': item.comment ?? null,
            })
                .then(res => {
                    console.log(res)
                    this.openAdditingModal = false;
                    this.listPresents = this.listPresents.map(el => el.id === res.data.id ? res.data : el)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
});
</script>

<style scoped>
.wish {
    border-radius: 10px;
    box-shadow: 15px 25px 50px -12px rgb(0 0 0 / 0.25);
    background-color: white;
    padding: 10px;
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
.btn.disabled {
    cursor: none;
    pointer-events: none;
    opacity: 0.3;
}
.btn_icon {
    color: #9b5bde;
    cursor: pointer;
    transition: .1s all ease-out;
}
.btn_icon:hover {
    color: #3fb37f;
    transform: scale(1.05);
}

/* presents */
.link {
    display: flex;
    justify-content: center;
    border-radius: 10px;
    border: 1px solid grey;
    padding: 10px;
    position: relative;
    transition: .5s;
}
.link:hover {
    border: 1px solid mediumvioletred;
}
.img_present {
    height: 300px;
    width: auto;
    transition: 1s;
}
.desc {
    position: absolute;
    opacity: 0;
    background: rgba(89, 90, 93, 0.68);
    color: white;
    height: 100%;
    margin-top: -10px;
    box-sizing: border-box;
    padding: 20px;
    font-size: 16px;
    border-radius: 10px;
    line-height: 24px;
    transition: 1s;
    width: 100%;
}
.link:hover .desc{
    opacity:1;
}
.link:hover .img_present{
    transform: scale(0.9);
}

.item{
    margin-top: 10px;
    border-bottom: 1px solid #9ca3af;
}
.scroll{
    height: 700px;
    overflow-y: auto;
}
@media (max-width: 800px) {
    .link_item, .btn, .btn_item {
        font-size: 14px;
    }
    .btn_item{
        padding: 8px 16px;
    }
    .scroll{
        height: 700px;
    }
}

@media (max-width: 640px) {
    .btn_item{
        padding: 4px 8px;
    }
    .img_present{
        height: 200px;
    }
    .desc{
        padding: 10px;
    }
    .scroll{
        height: 300px;
    }
}
</style>

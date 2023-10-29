<template>
    <Head title="Dashboard" />

    <MainLayout>
        <template #header>
            <h2 class="sm:font-semibold sm:text-xl sm:text-gray-800 sm:leading-tight text-sm">Приветствуем, {{$page.props.auth.user.name}} !</h2>
        </template>

        <div class="sm:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <div class="flex justify-between items-center items_flex p-4">
                        <img :src="$page.props.auth.user.avatar" alt="photo"
                             class="w-40 h-40 rounded-full bg-gray-100 text-white text-center">
                        <div class="content_item ml-8 sm:w-3/4 w-full">
                            <p class="text-xl font-medium">{{$page.props.auth.user.name}}</p>
                            <p class="italic text-base text-gray-400">{{$page.props.auth.user.nick}}</p>
                            <p class="italic text-base">{{$page.props.auth.user.birthday}}</p>
                            <div class="py-2 text-justify" v-html="$page.props.auth.user.about"></div>
                        </div>
                    </div>
                    <div class="sm:mt-8 mt-3 p-4">
                        <h3 class="text-xl underline ">Мероприятия</h3>
                        <div class="scroll">
                            <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-3 my-3" v-if="holidays.length > 0">
                                <div class="no_happy">
                                    <Link class="btn" :href="route('holiday.create')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 32 32" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">-->
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </Link>
                                </div>
                                <div class="flex justify-center" v-for="item in holidays">
                                    <div class="no_happy">
                                        <img class="img" :src="item.image" :alt="item.title">
                                        <button class="delete_btn" @click.prevent="deleteHoliday(item.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                        <Link class="btn_holly" :href="route('holiday.show', item.id)">Просмотр</Link>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="grid md:grid-cols-2 sm:grid-cols-1 gap-3 my-3">
                                <div class="no_happy">
                                    <Link class="btn" :href="route('holiday.create')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 32 32" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">-->
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>


<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head, Link, router} from '@inertiajs/vue3';
import {defineComponent} from "vue";

export default defineComponent({
    name: "Dashboard",
    components: {
        MainLayout,
        Head,
        Link
    },
    props: [
      'holidays'
    ],
    data: () =>({
        searchItem: ''
    }),
    methods: {
        router() {
            return router
        },
        deleteHoliday(id) {
            this.$inertia.delete(`/holiday/${id}`)
        },
        searchUser(){
            console.log(this.searchItem)

        }
    },
    watch: {
        holidays: function (val){
            console.log(val)
        }
    }
});
</script>

<style scoped>
.no_happy{
    height: 150px;
    max-width: 250px;
    background: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    cursor: pointer;
    position: relative;
    border: 1px solid rgba(104, 104, 104, 0);
}
@media (max-width: 900px) {
    .img{
        min-width: 100px;
    }
    .btn_holly{
        font-size: 16px;
    }
}
@media (max-width: 768px) {
    .no_happy{
       margin: auto;
        min-width: 250px;
    }
    .items_flex{
        flex-direction: column;
        align-items: center;
    }
    .content_item{
        margin-left: 0;
        margin-top: 10px;
    }
}
.img {
    position: relative;
    border-radius: 10px;
    display: block;
    width: 100%;
    height: 100%;
    max-height: 150px;
}
.btn_holly {
    position: absolute;
    text-decoration: none;
    background: #c668d2;
    color: white;
    padding: 15px 25px;
    border-radius: 10px;
    border-bottom: none;
    transition: .1s;
    cursor: pointer;
    font-weight: 500;
}

.btn{
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e5e5e5;
    cursor: pointer;
    transition: .1s linear;
}
.no_happy:hover {
    border: 1px solid #686868;
}
.btn_holly:hover {
    background: #9af5ca;
    color: white;
}
.delete_btn {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #ef4444;
    cursor: pointer;
    transition: .1s all ease-out;
}
.delete_btn:hover {
    transform: scale(1.05);
}

.scroll {
    height: 200px;
    overflow: auto;
}
</style>

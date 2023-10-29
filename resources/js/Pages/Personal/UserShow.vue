<template>
    <Head :title="user.name"/>
    <MainLayout>
        <template #header>
            <h2 class="sm:font-semibold sm:text-xl sm:text-gray-800 sm:leading-tight text-sm">Страница пользователя, {{user.name}}</h2>
            <Link :href="route('users.list')" class="hover:text-sky-400 link">Назад</Link>
        </template>

        <div class="sm:py-12 p-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <div class="flex justify-between items-center items_flex">
                        <img :src="user.avatar_url" alt="photo"
                             class="w-40 h-40 rounded-full bg-gray-100 text-white text-center">
                        <div class="content_item ml-8 sm:w-3/4 w-full">
                            <p class="text-xl font-medium">{{user.name}}</p>
                            <p class="italic text-base text-gray-400">{{user.nick}}</p>
                            <p class="italic text-base">{{user.birthday}}</p>
                            <div class="py-2 text-justify" v-html="user.about"></div>
                        </div>
                    </div>
                    <div class="sm:mt-8 mt-3">
                        <h3 class="text-xl underline">Мероприятия</h3>
                        <div class="scroll">
                            <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-3 my-3">
                                <div class="flex justify-center" v-for="item in user.holidays">
                                    <div class="no_happy">
                                        <img class="img" :src="item.image" :alt="item.title">
                                        <Link class="btn_holly" :href="route('holiday.show', item.id)">Просмотр</Link>
                                    </div>
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
import { Head, Link } from '@inertiajs/vue3';
export default {
    name: "UserShow.vue",
    components: {
        MainLayout,
        Head,
        Link
    },
    props: ['user'],

}
</script>

<style scoped>
.no_happy{
    height: 150px;
    width: 250px;
    background: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    cursor: pointer;
    position: relative;
    border: 1px solid rgba(104, 104, 104, 0);
}
.img {
    position: relative;
    border-radius: 10px;
    display: block;
    width: 100%;
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
.scroll {
    height: 450px;
    overflow: auto;
    margin-top: 10px;
}

/*media*/
@media (max-width: 900px) {
    .img{
        min-width: 100px;
    }
    .btn_holly{
        font-size: 16px;
    }
    .scroll {
        height: 350px;
    }
}
@media (max-width: 768px) {
    .link{
        font-size: 14px;
    }
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
    .scroll {
        height: 250px;
    }

}
@media (max-width:640px ) {
    .scroll {
        height: 180px;
    }
}
</style>

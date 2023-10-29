<template>
    <Head title="Presents" />
    <div>
        <MainLayout>
            <template #header>
                <h2 class="sm:font-semibold sm:text-xl sm:text-gray-800 sm:leading-tight text-sm">Выбранные подарки к мероприятиям</h2>
                <Link :href="route('dashboard.index')" class="hover:text-sky-400 link_item">Назад</Link>
            </template>
            <div class="p-4">
                <div v-if="presentsItems && presentsItems.length > 0" class="scroll">
                    <div v-for="item in presentsItems" :key="item.id" class="item_present">
                        <div class="flex items-center">
                                <Link :href="route('users.show', item.holiday.user.id)" class="link_avatar">
                                    <img class="avatar" :src="item.holiday.user.avatar_url" :alt="item.holiday.user.name">
                                </Link>
                                <div class="content_item">
                                    <Link :href="route('holiday.show', item.holiday.id)">
                                        <h3 class="holiday">Название мероприятия: {{item.holiday.title}}</h3>
                                    </Link>
                                    <p class="py-2 sm:text-base text-xs">Дата проведения: {{item.holiday.date}}</p>
                                </div>
                        </div>
                        <div class="my-3">
                            <h3 class="sm:text-lg underline text-emerald-500 text-base">Подарки:</h3>
                            <div>
                                <a :href="item.url_link" class="link">
                                    <img :src="item.image_url" :alt="item.name" class="img_present">
                                    <div class="desc">
                                        <h3 class="sm:text-lg text-base">Наименование:</h3>
                                        <p class="py-3 italic sm:text-base text-sm">{{item.name}}</p>
                                        <hr>
                                        <h3 class="py-3 sm:text-base text-sm" v-if="item.description && item.description.length > 0">Пожелания:</h3>
                                        <p class="sm:text-base text-sm">{{item.description}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <p>У вас пока нет выбранных подарков к мероприятиям</p>
                </div>
            </div>
        </MainLayout>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from "@/Layouts/MainLayout.vue";
export default {
    name: "Show.vue",
    components: {
        Head,
        Link,
        MainLayout
    },
    props: ['presentsItems']
}
</script>

<style scoped>
.item_present {
    padding: 10px;
    background-color: rgba(224, 221, 221, 0.29);
    border-radius: 10px;
    margin-bottom: 5px;
}
.avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    transition: .5s all;
}
.avatar:hover {
    transform: scale(1.1);
}
.link_avatar{
    border-bottom: none;
}
.content_item {
    margin-left: 20px;
}
.holiday {
    font-size: 20px;
    transition: .5ms all;
    position: relative;
    text-decoration: none;
    overflow: hidden;
    text-align: center;
}
.holiday::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 1px;
    background-color: #2563eb;
    transition: width 0.3s ease-in-out;
}
.holiday:hover, .holiday:hover::before {
    color: #2563eb;
    width: 100%;
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
    overflow-y: auto;
}
.link:hover .desc{
    opacity:1;
}
.link:hover .img_present{
    transform: scale(0.9);
}

.scroll{
    height: 700px;
    overflow-y: auto;
}

/*media*/
@media (max-width: 800px) {
    .link_item{
        font-size: 14px;
    }
    .scroll{
        height: 700px;
    }
}
@media screen and (max-width: 640px) {
    .holiday{
        font-size: 14px;
        text-align: left;
    }
    .avatar{
        height: 60px;
        width: 60px;
    }
    .img_present{
        height: 200px;
    }
    .desc{
        padding: 10px;
    }
    .scroll{
        height: 350px;
    }
}
</style>

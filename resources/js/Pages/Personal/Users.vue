<template>
    <Head title="Users" />
    <MainLayout>
        <template #header>
            <h2 class="sm:font-semibold sm:text-xl sm:text-gray-800 sm:leading-tight text-sm">Поиск пользователей</h2>
            <Link :href="route('dashboard.index')" class="hover:text-sky-400 link">Назад</Link>
        </template>
        <div class="sm:py-12 p-4">
            <div class="mb-4 sm:w-5/6 mx-auto sm:flex">
                <input type="text" v-model="searchItem" class="input_item" placeholder="Введите ник (@ivan) или имя пользователя (Ivan)">
                <button v-if="search == false" class="btn" @click="inputSearch">Поиск</button>
                <button v-else class="btn" @click="clearSearch">Очистить поиск</button>
            </div>
            <div v-if="errorSearch" class="text-xs text-red-600 text-center">
                {{ this.errorSearch }}
            </div>

            <div v-if="loading === false" class="scroll">
                <div v-for="user in list" :key="user.id" class="user_item" @click="getUser(user.id)">
                    <img :src="user.avatar_url" :alt="user.name">
                    <div class="ml-4">
                        <p class="text-lg">{{user.name}}</p>
                        <p class="text-gray-500 italic">{{user.nick}}</p>
                        <p class="text-gray-500">{{user.birthday === null ? '' : user.birthday}}</p>
                    </div>
                </div>
            </div>

            <div v-else class="border border-blue-300 shadow rounded-md p-4 w-5/6 w-[80%] mx-auto">
                <div class="animate-pulse flex space-x-4">
                    <div class="rounded-full bg-gray-300 h-10 w-10"></div>
                    <div class="flex-1 space-y-6 py-1">
                        <div class="h-2 bg-gray-300 rounded"></div>
                        <div class="space-y-3">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="h-2 bg-gray-300 rounded col-span-2"></div>
                                <div class="h-2 bg-gray-300 rounded col-span-1"></div>
                            </div>
                            <div class="h-2 bg-gray-300 rounded"></div>
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
    name: "Users.vue",
    components: {
        Head,
        MainLayout,
        Link
    },
    props: ['users'],
    data: () => ({
        searchItem: '',
        errorSearch: '',
        list: [],
        loading: false,
        search: false
    }),
    methods: {
        inputSearch(){
            if(this.searchItem !== null && this.searchItem.length > 0){
                this.loading = true;
                this.search = true;
                this.list = [];
                this.errorSearch = '';
                //удаляем все пробелы
                let str = this.searchItem.replace(/\s/g, '');
                let item = !str.includes('@') ? '@' + str : str;
                axios.post('/users/search', {nick: item})
                    .then(res => {
                        if(res.data.data === 0){
                            setTimeout(() => {this.loading = false, this.errorSearch = 'Пользователь не найден'}, 2000)
                        }else{
                            setTimeout(() => {this.loading = false}, 2000)
                            res.data.forEach(el => this.list.push(el));
                        }
                    })
                    .catch(err => {
                        setTimeout(() => {this.loading = false, this.errorSearch = 'Пользователь не найден'}, 2000)
                        console.log(err)
                    })
            }else{
                this.errorSearch = 'Необходимо ввести ник или имя пользователя';
            }
        },
        getUser(id){
            this.$inertia.get(`/users/${id}`);
        },
        clearSearch(){
            this.list = [];
            this.users.forEach(item => {
                this.list.push(item)
            });
            this.errorSearch = '';
            this.searchItem = '';
            this.search = false;
        }
    },
    mounted() {
        this.users.forEach(item => {
            this.list.push(item)
        });
    }
}
</script>

<style scoped>
.user_item {
    display: flex;
    width: 80%;
    margin: auto;
    height: 100px;
    align-items: center;
    border-bottom: 1px solid rgba(104, 104, 104, 0.38);
    padding: 10px;
    cursor: pointer;
}
.user_item:hover {
    background-color: rgba(223, 224, 227, 0.38);
}
.user_item img {
    height: 80px;
    width: 80px;
    border-radius: 50%;
}

.input_item {
    border: 1px solid rgba(104, 104, 104, 0.38);
    border-radius: 10px;
}
.btn {
    margin-left: 7px;
    border: 1px solid #7337de;
    text-align: center;
    padding: 5px 10px;
    color: #fff;
    background-color: #7337de;
    border-radius: 10px;
    transition: .1s;
    height: 40px;
    cursor: pointer;
}
.btn:hover{
    transform: scale(1.1);
}
.scroll{
    max-height: 600px;
    overflow-y: auto;
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
@media (max-width: 640px) {
    .btn{
        width: 100%;
        margin-left: 0;
    }
    .user_item{
        width: 100%;
    }
}
</style>

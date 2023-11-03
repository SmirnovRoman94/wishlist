<template>
        <div class="bg-animation" ref="bg" :style="{height: `${height}px`}">
            <div  class="w-1/2 bg-gray-100 items-center mx-auto shadow-gray-900/50 rounded-lg content_glaw">
                <header v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 flex items-center justify-between border border-black items">
                        <slot name="header"/>
                        <div v-if="$page.component === 'Dashboard'">
                            <div class="h-16 flex justify-center drop_item">
                                <div class="hidden sm:flex sm:items-center sm:ml-1/2">
                                    <!-- Settings Dropdown -->
                                    <div class="ml-3 relative">
                                        <Dropdown align="right" width="48">
                                            <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-gray-500 text-sm leading-4 font-medium rounded-md text-gray-500 hover:scale-110 hover:text-gray-900 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                            </template>

                                            <template #content >
                                                <DropdownLink :href="route('profile.edit')" class="w-48 text-center"> Смена пароля </DropdownLink>
                                                <DropdownLink :href="route('personal.edit')" class="w-48 text-center"> Личный кабинет </DropdownLink>
                                                <DropdownLink :href="route('users.list')" class="w-48 text-center">Поиск пользователей</DropdownLink>
                                                <DropdownLink :href="route('present.show')" class="w-48 text-center">Мои подарки</DropdownLink>
                                                <DropdownLink :href="route('logout')" method="post" as="button" class="w-48 text-center">
                                                    Выход
                                                </DropdownLink>
                                            </template>
                                        </Dropdown>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Page Content -->
                <main class="bg-white shadow" >
                    <slot />
                </main>
            </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const height = ref(0);
function innerHeight() {
    let heig = document.body.getElementsByClassName('content_glaw')[0].clientHeight;
    height.value = heig < window.innerHeight ? window.innerHeight : heig + 40;
    console.log(heig, window.innerHeight)
}
onMounted(() => {
    innerHeight()
})
</script>

<style scoped>
/*.fade-in {*/
/*    animation-name: fadeIn;*/
/*    animation-delay: 5s;*/
/*    animation-duration: 5s;*/
/*}*/
/*.fade-out {*/
/*    animation-name: fadeOut;*/
/*    animation-duration: 5s;*/
/*}*/
/*@keyframes fadeIn {*/
/*    from { opacity: 0; }*/
/*    to { opacity: 1; }*/
/*}*/
/*@keyframes fadeOut {*/
/*    0% { opacity: 1; }*/
/*    100% { opacity: 0; }*/
/*}*/

.bg-animation {
    animation: bg-animation 20s linear infinite;
    padding: 160px 20px;
    background-image: url('../../img/page_user.jpeg'); /* Фоновая картинка */
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    min-height: 130vh;
    /*height: content-box;*/
}
.items {
    align-items: center;
}

@media (max-width: 800px) {
    .bg-animation{
        padding: 80px 20px;
        font-size: 26px;
    }
}
@media (max-width: 620px) {
    .bg-animation {
        animation: bg-animation_phone 20s linear infinite;
    }
}
@media (max-width: 675px) {
    .content_glaw{
        width: 370px;
    }
    .hidden {
        display: block;
        margin-top: 15px;
    }
    .bg-animation{
        padding: 40px 20px;
    }
}
@media (max-width: 400px) {
    .bg-animation {
        padding: 20px 10px;
        font-size: 26px;
    }
    .content_glaw{
        width: 300px;
    }
}





@keyframes bg-animation {
    0% {
        background-size: 100%;
        background-position: 3% 3%
    }
    20% {
        background-size: 103%;
        background-position: 0% 6%;
    }
    40% {
        background-size: 106%;
        background-position: 3% 9%;
    }
    60% {
        background-size: 106%;
        background-position: 6% 10%;
    }
    80% {
        background-size: 103%;
        background-position: 3% 6%;
    }
    100% {
        background-size: 100%;
        background-position: 3% 3%
    }
}
@keyframes bg-animation_phone {
    0% {
        background-size: 250%;
        background-position: 3% 3%
    }
    20% {
        background-size: 253%;
        background-position: 0% 6%;
    }
    40% {
        background-size: 256%;
        background-position: 3% 9%;
    }
    60% {
        background-size: 256%;
        background-position: 6% 10%;
    }
    80% {
        background-size: 253%;
        background-position: 3% 6%;
    }
    100% {
        background-size: 250%;
        background-position: 3% 3%
    }
}

</style>

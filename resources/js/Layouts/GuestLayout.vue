<script setup>
</script>

<template>
    <div class="w-full flex ">
        <div class="bg_login w-1/2"></div>
        <div class="reg min-h-screen w-1/2  flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 max-w-screen-sm:pt-0">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg max-w-screen-sm:pt-0">
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg_login{
    background-image: url("../../img/bg-01.jpg");
    height: auto;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
@media (max-width: 900px) {
    .bg_login{
        display: none;
    }
    .reg{
        width: 100%;
        justify-content: center;
        background-image: url("../../img/bg-01.jpg");
        height: auto;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        padding-top: 0;
    }
}

.v-enter-active,
.v-leave-active {
    transition: opacity 3s ease;
}
.v-enter-from,
.v-leave-to {
    opacity: 0;
}


</style>

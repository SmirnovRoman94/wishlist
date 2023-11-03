<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue'
import VueTypewriterEffect from "vue-typewriter-effect";
import { KinesisContainer, KinesisElement } from 'vue-kinesis'
import shar from '../../img/shar.jpeg'
import shar2 from '../../img/shar_2.png'



defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});


const show = ref(false);
</script>


<template>
    <Head title="Welcome">
        <link rel="icon" type="image/svg+xml" href="/icon.png" />
    </Head>
    <!--Header-->
    <header id="fullscreen">
        <div class="logo" id="full"><a class="ajax-link" href="index.html">THOMSOON</a></div>
    </header>


    <transition name="fade">
        <div class="opacity-nav" v-if="show">
            <div class="menu-index" id="buttons" @click="show = !show" style="z-index:999999">
                <i class="fa  fa-close"></i>
            </div>
            <ul class="menu-fullscreen">
                <li><a class="ajax-link" href="single.html">Home</a></li>
                <li><a class="ajax-link" href="projects.html">Projects</a></li>
                <li><a class="ajax-link" href="about-us.html">About us</a></li>
                <li><a class="ajax-link" href="contact.html">Contact</a></li>
            </ul>
        </div>
    </transition>

    <!--Content-->

    <div class="content" id="ajax-content">
        <div class="text-intro" id="site-type">

            <h1>My creative and simplicity modern</h1>
            <vue-typewriter-effect :strings="['birthday', 'new year']"/>
            <p>Здесь вы можете создать свой список желаний на любое Ваше мероприятие.</p>
        </div>

        <!--Portfolio grid-->
        <div class="form" v-if="canLogin">
            <Link v-if="$page.props.auth.user"  :href="route('dashboard.index')" class="btn-slice">
                <div class="top"><span>Личный кабинет</span></div>
                <div class="bottom"><span>Личный кабинет</span></div>
            </Link>
            <template v-else>
                <Link class="btn-slice" :href="route('login')">
                    <div class="top"><span>Login</span></div>
                    <div class="bottom"><span>Login</span></div>
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="btn-slice">
                    <div class="top"><span>Register</span></div>
                    <div class="bottom"><span>Register</span></div>
                </Link>
            </template>
        </div>

    </div>


    <!--Home Sidebar-->

    <div>
        <div class="home-sidebar">
            <kinesis-container>
                <kinesis-element :strength="10">
                    <div class="circle-purple1"></div>
                </kinesis-element>
                <kinesis-element :strength="20">
                    <div class="circle-purple2"></div>
                </kinesis-element>
                <kinesis-element :strength="20">
                    <div class="circle-purple3"></div>
                </kinesis-element>
                <kinesis-element>
                    <img :src="shar2" style="margin-top: -80%"/>
                </kinesis-element>
                <kinesis-element>
                    <img :src="shar"/>
                </kinesis-element>
                <kinesis-element :strength="30">
                    <div class="circle-purple1"></div>
                </kinesis-element>
                <kinesis-element :strength="40">
                    <div class="circle-purple2"></div>
                </kinesis-element>
                <kinesis-element :strength="40">
                    <div class="circle-purple3"></div>
                </kinesis-element>
            </kinesis-container>
        </div>
    </div>


    <!--Footer-->

<!--    <footer>-->
<!--        <div class="footer-margin">-->
<!--            <div class="social-footer">-->
<!--                <a href="https://www.facebook.com/thomsooncom"><i class="fa fa-facebook"></i></a>-->
<!--                <a href="https://www.behance.net/TomaszMazurczak"><i class="fa fa-behance"></i></a>-->
<!--            </div>-->
<!--            <div class="copyright">© Copyright 2015 Thomsoon.com. All Rights Reserved.</div>-->
<!--        </div>-->
<!--    </footer>-->
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
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

.Typewriter__wrapper{
    font-size: 43px;
    text-transform: uppercase;
    line-height: 70px;
    font-weight: 700;
}
.Typewriter__cursor{
    font-size: 70px;
}
.circle-purple {
    border: 10px solid #af80de;
    opacity: 0.2;
    width: 4vw;
    height: 4vw;
    left: 10%;
    top: 90%;
    border-radius: 100%;
    position: relative;
}
.circle-purple1 {
    margin-top: 50px;
    border: 10px solid #8334dc;
    opacity: 0.2;
    width: 4vw;
    height: 4vw;
    left: 80%;
    bottom: 17%;
    border-radius: 100%;
    position: relative;
}
.circle-purple2 {
    margin-top: 20px;
    border: 10px solid #ca15d7;
    opacity: 0.2;
    width: 4vw;
    height: 4vw;
    left: 10%;
    top: 25%;
    border-radius: 100%;
    position: relative;
}
.circle-purple3 {
    margin-top: 40%;
    left: 60%;
    border: 10px solid #db96e0;
    opacity: 0.2;
    width: 4vw;
    height: 4vw;
    border-radius: 100%;
    position: relative;
}
.home-sidebar {
    background-image: url("../../img/5183000.jpg");
    background-size: cover;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: center;
}

.form {
    margin: 150px 154px auto 154px;
    display: flex;
    width: 40%;
    justify-content: space-between;
}
@media (max-width: 1023px) {
    .content {
        background-image: url("../../img/5183000.jpg");
        background-size: cover;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: center;
        margin: 0;
        min-height: 100vh;
        height: content-box;
    }
    .content .text-intro {
        margin: 0px auto 0;
        padding-top: 50px;
    }
}
@media (max-width: 900px) {
    .form {
        margin: 70px auto 0px;
        flex-direction: column;
    }
    .btn-slice {
        margin-bottom: 10px;
    }
}
@media (max-width: 480px) {
    .form {
        margin: 50px auto;
        flex-direction: column;
        width: 250px;
    }
    .btn-slice {
        margin-bottom: 10px;
    }
}




.btn-slice {
    padding: 1.2rem 2.5rem;
    border: 2px solid #E54FC8B2;
    border-radius: 0rem;
    color: #E54FC8B2;
    font-size: 0.6875rem;
    font-weight: 700;
    letter-spacing: 0.3rem;
    position: relative;
    transition: all 1000ms cubic-bezier(0.890, -0.170, 0.140, 1.225); /* custom */
    transition-timing-function: cubic-bezier(0.890, -0.170, 0.140, 1.225); /* custom */
}

.btn-slice .top  {
    position: relative;
    height: 6px;
    overflow: hidden;
    top: 0;
    transition: all 300ms cubic-bezier(1.000, -0.055, 0.025, 1.040); /* custom */
    transition-timing-function: cubic-bezier(1.000, -0.055, 0.025, 1.040); /* custom */
    transition-delay:0.35s;
}

.btn-slice .bottom  {
    position: relative;
    height: 6px;
    overflow: hidden;
    bottom: 0;
    transition: all 300ms cubic-bezier(1.000, -0.055, 0.025, 1.040); /* custom */
    transition-timing-function: cubic-bezier(1.000, -0.055, 0.025, 1.040); /* custom */
    transition-delay:0.35s;
}

.btn-slice .bottom span {
    top: -6px;
    position: absolute;
    left: 0;
}

.btn-slice:hover .top {
    top: -5px;
    transition-delay:0.35s;
}

.btn-slice:hover .bottom {
    bottom: -5px;
    transition-delay:0.35s;
}
.btn-slice:hover, .btn-slice:focus, .btn-slice:active {
    margin-left: 10px;
}
.btn-slice:before{
    content: '';
    height: 1px;
    width: 60px;
    background-color: #E54FC8B2;
    position: absolute;
    margin-top: 6px;
    right: -35px;
    transition: all 1000ms cubic-bezier(0.890, -0.170, 0.140, 1.225); /* custom */
    transition-timing-function: cubic-bezier(0.890, -0.170, 0.140, 1.225); /* custom */
}
.btn-slice:hover:before{
    width: 130%;
}
</style>

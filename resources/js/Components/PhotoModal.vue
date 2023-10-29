<template>
    <transition name="fade">
        <div class="upload-example flex justify-center " v-show="dialog">
            <div @click="close"  class="back" :style="{height:`${itemHeight}px`}">
            </div>
            <div class="dialog" ref="myBlockPhoto" :style="{marginTop: `${margineTop}px`}">
                <div @click="close" class="pt-3 block flex justify-end pr-4 cursor-pointer ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <img :src="imageSrc" alt="camera" v-if="image == null">
                <div v-else>
                    <Cropper
                        v-if="type == 'avatar'"
                        ref="cropper"
                        class="upload-example-cropper"
                        :src="image"
                        :stencil-component="$options.components.CircleStencil"
                        :stencil-props="{resizable: true, aspectRatio: 1/1}"
                    />
                    <Cropper
                        v-else
                        ref="cropper"
                        class="upload-example-cropper"
                        :src="image"
                        :default-size="{width: 400, height: 400}"
                    />
                </div>
                <div class="button-wrapper">
                        <span class="button" @click="$refs.file.click()">
                          <input
                              type="file"
                              ref="file"
                              @change="uploadImage($event)"
                              accept="image/*"
                          />
                          Загрузить заново
                        </span>
                    <span class="button" @click="cropImage" v-if="this.image !== null">Обрезать</span>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
import { Cropper } from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';
import img from '../../img/camera.png'
import {nextTick} from "vue";
export default {
    name: "PhotoModal.vue",
    components: {
        Cropper
    },
    props: {
        open: {
            type: Boolean,
            default: false
        },
        type: {
            type: String,
            default: 'default'
        },
    },
    data() {
        return {
            dialog: false,
            image: null,
            nameImage: '',
            typeImage: '',

            itemHeight: null,
            margineTop: null,

            imageSrc: img
        }
    },
    emits: ['result', 'update:open'],
    methods: {
        innerHeight() {
            this.itemHeight = document.body.getElementsByClassName('bg-animation')[0].clientHeight;
            this.margineTop = window.innerHeight < this.itemHeight ? this.itemHeight - window.innerHeight : null;
        },
        uploadImage(event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                this.nameImage = input.files[0].name;
                this.typeImage = input.files[0].type;
                reader.onload = (e) => {
                    this.image = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        cropImage() {
            const result = this.$refs.cropper.getResult();
            const res = result.canvas.toDataURL("image/jpg");
            this.$emit('result', res);
            this.dialog = false;
        },
        close() {
            this.$emit('update:open', false)
        }
    },
    watch: {
        open: function (){
            this.dialog = this.open;
            this.innerHeight();

            if(this.open === false){
                setTimeout(() => {
                    this.image = null
                },500)
            }
            // if(this.open === true){
            //     document.body.classList.add("overflow-hidden");
            // }else{
            //     document.body.classList.remove("overflow-hidden");
            // }
        }
    }
}
</script>

<style scoped>
.overflow-hidden{
    overflow: hidden;
}
img {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    /*padding-top: 35px;*/
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity  1s ease;
}
.dialog {
    position: absolute;
    z-index: 991;
    background-color: #fff;
    width: 350px;
    top: 30%;
    border-radius: 10%;
}
.button-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 17px;
    margin-bottom: 10px;
}

.button {
    color: white;
    font-size: 16px;
    padding: 10px 20px;
    background: #3fb37f;
    cursor: pointer;
    transition: background 0.5s;
    font-family: Open Sans, Arial;
    margin: 0 10px;
    border-radius: 10px;
    cursor: pointer;
}
.button:hover {
    background: #38d890;
}
.button input {
    display: none;
}
.upload-example-cropper {
    border: none !important;
    height: 300px !important;
    width: 300px !important;
    background-color: white;
    margin: 0 auto;
}
.upload-example-cropper {
    border: solid 1px #EEE;
    min-height: 300px;
    width: 100%;
}
.vue-advanced-cropper.upload-example-cropper >>> .vue-advanced-cropper__foreground, .vue-advanced-cropper__background{
    background: white !important;
}
.back {
    position: absolute;
    background-color: black;
    opacity: .4;
    z-index: 991;
    width: 100%;
    top: 0;
    height: 100vh;
}
@media screen and (min-width: 400px){
    .item_modal{
        width: 100%;
    }
}
@media (max-width: 800px) {
   .dialog{
       width: 300px;
       top: 10%;
   }
    .button{
        font-size: 16px;
    }
}
</style>

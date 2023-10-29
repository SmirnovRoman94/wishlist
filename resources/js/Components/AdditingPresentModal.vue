<template>
    <transition name="fade">
        <div class="upload-example flex justify-center " v-if="dialog">
            <div @click="close"  class="absolute bg-black opacity-70 inset-0 z-[991]  min-w-full w-96" :style="{height: `${itemHeight}px`}">
            </div>
            <div class="dialog">
                <div class="flex items-center justify-between ">
                    <h2 class="text-lg ">Выбор подарка</h2>
                    <div @click="close" class="block flex justify-end pr-4 cursor-pointer ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ваш комментарий к подарку</label>
                    <textarea type="text" v-model="item.comment" class="input" placeholder="Выбрали другой цвет, товар закончился, разделил между другими пользователями"></textarea>
                </div>
                <div class="button-wrapper">
                    <span class="button" @click="addPresentModal">Сохранить</span>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
import TextInput from "@/Components/TextInput.vue";

export default {
    name: "AdditingPresentModal.vue",
    components: {TextInput},
    props: {
        open: {
            type: Boolean,
            default: false
        },
        editingItem: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            dialog: false,
            item: {
                comment: ''
            },
            itemHeight: null
        }
    },
    emits: ['result',  'update:open'],
    methods: {
        innerHeight() {
            this.itemHeight = document.body.getElementsByClassName('bg-animation')[0].clientHeight
        },
        close() {
            this.$emit('update:open', false)
        },
        addPresentModal(){
            this.$emit('result', this.item)
        }
    },
    watch: {
        open: function (){
            this.dialog = this.open;
            if(this.open === true){
                this.innerHeight()
            }
            // if(this.open === true){
            //     document.body.classList.add("overflow-hidden");
            // }else{
            //     document.body.classList.remove("overflow-hidden");
            // }


            if(this.editingItem !== null){
                Object.assign(this.item, this.editingItem)
            }
        },
        dialog: function () {
            if(this.dialog === false) {
                this.item.comment = ''
            }
        }
    }
}
</script>

<style scoped>
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 500ms ease;
}
.input {
    border: 1px solid rgba(128, 128, 128, 0.59);
    border-radius: 7px;
    margin-top: 4px;
    min-height: 250px;
}
.dialog {
    position: absolute;
    z-index: 991;
    background-color: #fff;
    width: 450px;
    top: 30%;
    height: auto;
    min-height: 30%;
    border-radius: 10px;
    padding: 20px;
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
}
.button:hover {
    background: #38d890;
}
.button input {
    display: none;
}

</style>

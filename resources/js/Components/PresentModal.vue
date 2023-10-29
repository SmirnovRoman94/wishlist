<template>
    <transition name="fade">
        <div class="flex justify-center" v-show="dialog">
            <div @click="close" class="absolute bg-black opacity-20 inset-0 z-[990]" :style="{height: `${itemHeight}px`}">
            </div>
            <div class="dialog" ref="myBlock">
                <div @click="close" class="flex justify-end w-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div v-if="loading" class="item_loading">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                </div>
                <div>
                    <div class="mb-2 px-2">
                        <label>Ссылка на подарок</label>
                        <input type="text" v-model="url" class="input" placeholder="href://....">
                        <div>
                            <button class="btn" @click="fetchOpenGraphData">Загрузить ссылку</button>
                        </div>
                        <div v-if="this.errorGraph && url || this.errorStore" class="text-xs text-red-600">
                            {{ this.errorGraph || this.errorStore}}
                        </div>
                    </div>

                    <div class="mb-2 px-2">
                        <label>Наименование подарка</label>
                        <input type="text" v-model="title" class="input" placeholder="Введите название товара/услуги">
                        <div v-if="this.errorGraph && url || this.errorStore" class="text-xs text-red-600">
                            {{ this.errorGraph || this.errorStore}}
                        </div>
                    </div>
                    <div class="mb-2 px-2">
                        <label>Пожелания</label>
                        <input type="text" v-model="description" class="input" placeholder="Здесь можно указать определнный цвет или модель">
                        <div v-if="this.errorGraph && url" class="text-xs text-red-600 pt-2">
                            {{ this.errorGraph }}
                        </div>
                    </div>
                    <div class="scroll2 mb-4 px-2">
                        <a href="#" @click.prevent="openModal = true" :class="['block overflow-hidden bg-gray-200 rounded-lg', !imageUrl ? 'h-40' : '']">
                            <div v-if="!imageUrl" class="flex justify-center items-center h-40">
                                <span class="block italic text-gray-500 text-center text-sm">Добавить картинку подарка <br> (желательно горизонтального формата )</span>
                            </div>
                            <img v-else :src="imageUrl" :alt="title" class="w-full block">
                            <div v-if="this.errorImage" class="text-xs text-red-600 pt-2">
                                {{ this.errorImage }}
                            </div>
                        </a>
                    </div>
                    <div class="mt-2" v-if="editId == null">
                        <button class="btn" @click="save">Добавить</button>
                    </div>
                    <div class="mt-2" v-else>
                        <button class="btn" @click="update">Изменить</button>
                    </div>
                </div>
            </div>
            <PhotoModal v-model:open="openModal" :type="'default'" @result="resultPhoto"/>
        </div>
    </transition>
</template>

<script>
import PhotoModal from "@/Components/PhotoModal.vue";
export default {
    name: "PresentModal.vue",
    components: {
        PhotoModal
    },
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
    emits:['update:open', 'result'],
    data() {
        return {
            dialog: false,
            loading: false,

            url: null,

            title: null,
            description: null,
            imageUrl: null,

            editId: null,

            errorGraph: null,
            errorImage: null,
            errorStore: null,

            openModal: false,

            itemHeight: null
        }
    },
    methods: {
        innerHeight() {
            this.itemHeight = document.body.getElementsByClassName('bg-animation')[0].clientHeight
        },
        close(){
            this.$emit('update:open', false)
        },
        async fetchOpenGraphData() {
            this.loading = true;
            await axios.post(`/present/create_link`, {
                link: this.url
            })
                .then(res => Object.keys(res.data).length > 1
                    ? ( this.title = res.data.title,
                            this.description = res.data.description,
                            this.imageUrl = res.data.image,

                            this.loading = false
                    )
                    : (this.errorGraph = 'Невозможно проверить указанную ссылку, заполните данные самостоятельно', this.loading = false)
                )
                .catch(err => {
                    this.errorGraph = 'Невозможно проверить указанную ссылку, заполните данные самостоятельно',
                        this.loading = false
                    console.log(err)
                })
        },
        resultPhoto(res) {
            this.imageUrl = res
        },

        save() {
            console.log(`title: ${this.title}, url: ${this.url}, descr: ${this.description}, image: ${this.imageUrl}`)
            if((!this.title || this.title.length === 0) || (!this.url || this.url.length === 0)){
                this.errorStore = 'Данное поле обязательно для заполнения'
            }else{
                axios.post('/present', {
                    'holiday_id': this.$page.props.holidayItem.id,
                    'title': this.title,
                    'link': this.url,
                    'description': this.description ?? null,
                    'image': this.imageUrl ?? null,
                })
                    .then(res => {
                        this.$emit('result', res.data)
                        this.close()
                    })
                    .catch(err => {
                        this.close()
                        console.log(err)
                    })
            }
        },
        update() {
            console.log('update')
            axios.patch(`/present/${this.editId}`, {
                'holiday_id': this.$page.props.holidayItem.id,
                'title': this.title,
                'link': this.url,
                'description': this.description,
                'image': this.imageUrl,
                'id': this.editId
            })
                .then(res => {Object.keys(res.data).length > 0
                    ? (this.$emit('update', res.data), this.close())
                    : console.log(res)
                })
                .catch(err => {
                    console.log(err)
                    this.close()
                })

        },
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
        },
        editingItem: function (){
          if(this.editingItem !== null){
              this.editId = this.editingItem.id
              this.url = this.editingItem.url
              this.title = this.editingItem.title
              this.description = this.editingItem.description
              this.imageUrl = this.editingItem.imageUrl
          }
        },
        dialog: function (){
            if(this.dialog === false) {
                this.url = null
                this.title = null
                this.description = null
                this.imageUrl = null

                this.errorGraph = null
                this.errorImage = null
                this.errorStore = null
                this.editId = null
            }
        },

    }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.dialog {
    position: absolute;
    z-index: 990;
    background: #f5f3f3;
    padding: 10px;
    border-radius: 10px;
    top: 20%;
    width: 40%;
    border: 1px solid rgba(141, 141, 141, 0.39);
}
.input {
    border: 1px solid rgba(128, 128, 128, 0.59);
    border-radius: 7px;
    margin-top: 4px;
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
/* dialog  */
.scroll {
    height: 550px;
    overflow: auto;
}
.scroll2 {
    height: 250px;
    overflow: auto;
}


/*  loading */
.item_loading {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.19);
    height: 100%;
    width: 100%;
    margin-top: -34px;
    margin-left: -10px;
    border-radius: 10px;
    transition: .5s ease-in-out all;
}
.lds-ring {
    top: 40%;
    left: 40%;
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}
.lds-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 64px;
    height: 64px;
    margin: 8px;
    border: 8px solid #fff;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #fff transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
}
@keyframes lds-ring {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@media (max-width: 800px) {
    .dialog{
        top: 10%;
    }
    label {
        font-size: 14px;
    }
}
@media (max-width: 640px) {
    .dialog{
        width: 90%;
    }

}
@media (max-width: 350px) {
    .dialog{
        top: 20px;
    }
   .scroll2{
        height: 200px;
    }
}
</style>

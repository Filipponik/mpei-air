<template>
    <default-layout>
        <div class="lg:w-1/2 md:w-2/3 sm:w-full container px-2 py-20 mx-auto border border-indigo-500 bg-gray-100 rounded-lg">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Обратная связь</h1>
                <p id="label" class="lg:w-2/3 mx-auto leading-relaxed text-base">Если у вас возникли проблемы, появились вопросы или интересные предложения, пишите нам</p>
                <p v-if="sent === true && success === true" class="lg:w-2/3 mx-auto leading-relaxed text-base text-indigo-500">Ваше сообщение отправлено, спасибо!</p>
                <p v-else-if="sent === true && success === false" class="lg:w-2/3 mx-auto leading-relaxed text-base text-red-500">К сожалению, что-то пошло не так. Проверьте корректность заполнения всех полей.</p>
            </div>
            <div class="w-full md:w-3/4 mx-auto">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="name" class="leading-7 text-sm text-gray-600">Имя</label>
                            <input type="text" id="name" name="name" v-model="form.name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" :class="[ fields.name ? 'border-gray-300' : 'border-red-500' ]">
                        </div>
                        <a v-if="use_data_label" href="#" @click="use_data" class="text-xs text-gray-500 mt-3 hover:text-gray-900" id="use_data">Использовать свои данные</a>
                    </div>

                    <div class="p-2 w-1/2">
                        <div class="relative">
                            <label for="email" class="leading-7 text-sm text-gray-600">E-Mail</label>
                            <input type="email" id="email" name="email" v-model="form.email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" :class="[ fields.email ? 'border-gray-300' : 'border-red-500' ]">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="message" class="leading-7 text-sm text-gray-600">Сообщение</label>
                            <textarea id="message" name="message" v-model="form.message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out h-32" :class="[ fields.message ? 'border-gray-300' : 'border-red-500' ]"></textarea>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button @click="send_message" class="flex uppercase mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" name="send">Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    </default-layout>
</template>



<script>
    import DefaultLayout from '@/Layouts/DefaultLayout'

    export default {
        props: ['',],

        components: {
            DefaultLayout,

        },

        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    message: '',
                },
                fields: {
                    name: true,
                    email: true,
                    message: true,
                },
                success: false,
                sent: false,
                use_data_label: false,
                token: this.$page.props?.user?.defaultToken,
            }
        },

        mounted() {
            if (this.$page.props?.user?.defaultToken) {
                this.use_data_label = true
            }
        },

        methods: {
            use_data: function() {
                if (this.token) {
                    this.form.name = this.$page.props?.user?.im + ' ' + this.$page.props?.user?.fam
                    this.form.email = this.$page.props?.user?.email
                    this.use_data_label = false;
                }
            },
            send_message: function() {
                let error = false

                if (this.form.name.trim() == '') {
                    this.fields.name = false
                    this.sent = true
                    this.success = false
                    error = true
                }
                if (this.form.email.trim() == '') {
                    this.fields.email = false
                    this.sent = true
                    this.success = false
                    error = true
                }
                if (this.form.message.trim() == '') {
                    this.fields.message = false
                    this.sent = true
                    this.success = false
                    error = true
                }
                if (error)
                    return error

                axios({
                    method: 'POST',
                    url: '/api/support/send',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': (this.token) ? 'Bearer ' + this.token : ''
                    },
                    data: {
                        name: this.form.name,
                        email: this.form.email,
                        message: this.form.message,
                    }
                }).then((response) => {
                    // TODO Обработка результата
                    this.sent = true
                    this.success = true
                    console.log(response.data)
                }).catch((error) => {
                    this.sent = true
                    this.success = false
                });
            }
        }
    }
</script>

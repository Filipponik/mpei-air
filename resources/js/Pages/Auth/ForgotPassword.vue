<template>
    <default-layout>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-15 mx-auto flex flex-wrap items-center">
                <div class="border border-indigo-500 lg:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto md:mr-auto w-full mt-5 md:mt-0">
                    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Восстановление пароля</h2>

                    <p class="text-base text-gray-500 mb-3">Забыли пароль? Не проблема. Напишите адрес своей электронной почты и мы пришлем вам ссылку для восстановления пароля, после чего вы сможете выбрать себе новый пароль.</p>
                    
                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                        {{ status }}
                    </div>
                    
                    <jet-validation-errors class="mb-4" />

                    <form @submit.prevent="submit">
                        <div class="relative mb-4">
                            <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                            <input type="email" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" v-model="form.email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="ivanov@mail.ru" required autofocus>
                        </div>
                        <button name="reset_password" id="reset_password" class="w-full text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg select-none">Отправить ссылку восстановления</button>
                    </form>
                </div>
            </div>
        </section>
    </default-layout>
</template>

<script>
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import DefaultLayout from '@/Layouts/DefaultLayout'

    export default {
        components: {
            JetValidationErrors,
            DefaultLayout
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>

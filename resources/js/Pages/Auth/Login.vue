<template>
    <default-layout>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-15 mx-auto flex flex-wrap items-center">
                <div class="border border-indigo-500 lg:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto md:mr-auto w-full mt-5 md:mt-0">
                    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Авторизация</h2>

                    <jet-validation-errors class="mb-4" />

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                        {{ status }}
                    </div>
                    <form @submit.prevent="submit">
                        <div class="relative mb-4">
                            <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                            <input type="text" v-model="form.email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="ivanov@mail.ru" required>
                        </div>
                        <div class="relative mb-4">
                            <label for="password" class="leading-7 text-sm text-gray-600">Пароль</label>
                            <input type="password" v-model="form.password" id="password" name="password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="••••••••" required>
                        </div>
                        <button name="auth_button" id="auth_button" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="w-full text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg select-none">Войти</button>
                    </form>
                    <inertia-link :href="route('register')" class="text-xs text-gray-500 mt-3 hover:text-gray-900">Хотите создать новый аккаунт?</inertia-link>
                    <inertia-link :href="route('password.request')" class="text-xs text-gray-500 mt-1 hover:text-gray-900">Забыли пароль?</inertia-link>
                </div>
            </div>
        </section>
    </default-layout>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import DefaultLayout from '@/Layouts/DefaultLayout'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            DefaultLayout
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        mounded() {
            document.title = 'Авторизация'
        },
        
        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>

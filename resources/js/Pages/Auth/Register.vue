<template>
    <default-layout>
        <section class="text-gray-600 body-font sm:mx-0">
            <div class="container py-15 mx-auto flex flex-wrap items-center">
                <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0 text-center sm:text-left">
                    <h1 class="title-font font-medium text-3xl text-gray-900">Зарегистрируйтесь, чтобы иметь возможность бронировать билеты</h1>
                    <p class="leading-relaxed mt-4">Также Вы сможете следить за своими рейсами, подписаться на уведомления и получать ускоренную поддержку.</p>
                </div>
                <div class="border border-indigo-500 lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                    <h2 class="text-gray-900 text-lg font-medium title-font">Регистрация</h2>

                    <jet-validation-errors class="mb-4" />

                    <p class="text-xs text-gray-500 m-0 mb-5 p-0 hover:text-gray-900">(поля, помеченные звездочкой, обязательны для заполнения)</p>

                    <form @submit.prevent="submit">
                        <div v-for="(field, key) in fields" class="relative mb-4">
                            <div v-if="field.type == 'text' || field.type == 'password'">
                                <label :for="key" class="leading-7 text-sm text-gray-600">{{ field.shown_name }}<span v-show="field.required" class="text-red-500">*</span></label>
                                <input :type="field.type" :id="key" v-model="field.model" :name="key" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" :placeholder="field.placeholder" :required="field.required">
                            </div>
                            <div v-else-if="field.type == 'radio'">
                                <p class="leading-7 text-sm text-gray-600"> {{ field.shown_name }}<span v-show="field.required" class="text-red-500">*</span></p>
                                <div v-for="value in field.values">
                                    <input type="radio" :name="key" :id="value.name" :value="value.name" v-model="field.model">
                                    <label class="mx-2 w-full" :for="value.name">{{ value.shown_name }}</label>
                                </div>
                            </div>
                            <div v-else-if="field.type == 'date'">
                                <p class="leading-7 text-sm text-gray-600"> {{ field.shown_name }}<span v-show="field.required" class="text-red-500">*</span></p>
                                <v-date-picker v-model="field.model"
                                    :max-date="new Date()">
                                    <template v-slot="{ inputValue, inputEvents }">
                                        <text-input
                                        class="w-full"
                                        :id="key"
                                        :value="inputValue"
                                        :ph="field.placeholder"
                                        v-on="inputEvents" 
                                        />
                                    </template>
                                </v-date-picker>
                            </div>
                        </div>

                        <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="select-none w-full text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Зарегистрироваться</button>
                    </form>

                    <inertia-link class="text-xs text-gray-500 mt-3 hover:text-gray-900" :href="route('login')">Уже есть аккаунт? Войти</inertia-link>
                </div>
            </div>
        </section>
    </default-layout>
</template>

<script>
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import DefaultLayout from '@/Layouts/DefaultLayout'
    import TextInput from '@/Components/TextInput'

    export default {
        components: {
            JetLabel,
            JetValidationErrors,
            DefaultLayout,
            TextInput
        },
        data() {
            return {
                form: false,
            }
        },
        
        computed: {
            fields: function () {
                return {
                    'fam': {
                        'shown_name': 'Фамилия',
                        'type': 'text',
                        'model': '',
                        'placeholder': 'Иванов',
                        'required': true,
                    },
                    'im': {
                        'shown_name': 'Имя',
                        'type': 'text',
                        'model': '',
                        'placeholder': 'Иван',
                        'required': true,
                    },
                    'otch': {
                        'shown_name': 'Отчество',
                        'type': 'text',
                        'model': '',
                        'placeholder': 'Иванович',
                        'required': false,
                    },
                    'sex': {
                        'shown_name': 'Пол',
                        'type': 'radio',
                        'model': '',
                        'placeholder': '',
                        'required': true,
                        'values': [
                            {
                                name: 'male',
                                shown_name: 'Мужской',
                            },
                            {
                                name: 'female',
                                shown_name: 'Женский',
                            },
                        ]
                    },
                    'birth_date': {
                        'shown_name': 'Дата рождения',
                        'type': 'date',
                        'model': '',
                        'placeholder': '01.01.1990',
                        'required': false,
                    },
                    'email': {
                        'shown_name': 'Электронная почта',
                        'type': 'text',
                        'model': '',
                        'placeholder': 'ivanov@mail.ru',
                        'required': true,
                    },
                    'login': {
                        'shown_name': 'Логин',
                        'type': 'text',
                        'model': '',
                        'placeholder': 'ivanov',
                        'required': true,
                    },
                    'password': {
                        'shown_name': 'Пароль',
                        'model': '',
                        'type': 'password',
                        'placeholder': '••••••••••••••••',
                        'required': true,
                    },
                    'password_confirmation': {
                        'shown_name': 'Подтверждение пароля',
                        'model': '',
                        'type': 'password',
                        'placeholder': '••••••••••••••••',
                        'required': true,
                    },
                }
            }
        },

        methods: {
            submit() {
                console.log({
                    fam: this.fields.fam.model,
                    im: this.fields.im.model,
                    otch: this.fields.otch.model,
                    sex: this.fields.sex.model,
                    birth_date: this.fields.birth_date.model,
                    email: this.fields.email.model,
                    login: this.fields.login.model,
                    password: this.fields.password.model,
                    password_confirmation: this.fields.password_confirmation.model,
                })
                this.form = this.$inertia.form({
                    fam: this.fields.fam.model,
                    im: this.fields.im.model,
                    otch: this.fields.otch.model,
                    sex: this.fields.sex.model,
                    birth_date: this.fields.birth_date.model,
                    email: this.fields.email.model,
                    login: this.fields.login.model,
                    password: this.fields.password.model,
                    password_confirmation: this.fields.password_confirmation.model,
                })
                this.form.post(this.route('register'), { 
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            },
        }
    }
</script>

<template>
    <Header />
    <section class="text-gray-600 body-font mx-1 sm:mx-0">
        <div class="container py-15 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0 text-center sm:text-left">
                <h1 class="title-font font-medium text-3xl text-gray-900">Зарегистрируйтесь, чтобы иметь возможность бронировать билеты</h1>
                <p class="leading-relaxed mt-4">Также Вы сможете следить за своими рейсами, подписаться на уведомления и получать ускоренную поддержку.</p>
            </div>
            <div class="border border-indigo-500 lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                <h2 class="text-gray-900 text-lg font-medium title-font">Регистрация</h2>
                <p class="text-xs text-gray-500 m-0 mb-5 p-0 hover:text-gray-900">(поля, помеченные звездочкой, обязательны для заполнения)</p>
                <form action="reg.php" method="POST">
                    <div v-for="field in fields" class="relative mb-4">
                        <label :for="field.name" class="leading-7 text-sm text-gray-600">{{ field.shown_name }}<span v-show="field.required" class="text-red-500">*</span></label>
                        <input :type="field.type" :id="field.name" :name="field.name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" :placeholder="field.placeholder" :required="field.required">
                    </div>
                    <button class="select-none w-full text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Зарегистрироваться</button>
                </form>
                <a class="text-xs text-gray-500 mt-3 hover:text-gray-900" :href="route('login')">Уже есть аккаунт? Войти</a>
            </div>
        </div>
    </section>
    <Footer />
    <!-- <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </inertia-link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
    </jet-authentication-card> -->
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import Header from '@/Components/Header'
    import Footer from '@/Components/Footer'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Header,
            Footer
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                }),
                fields: [
                    {
                        'name': 'fam',
                        'type': 'text',
                        'shown_name': 'Фамилия',
                        'placeholder': 'Иванов',
                        'required': true,
                    },
                    {
                        'name': 'im',
                        'shown_name': 'Имя',
                        'type': 'text',
                        'placeholder': 'Иван',
                        'required': true,
                    },
                    {
                        'name': 'otch',
                        'shown_name': 'Отчество',
                        'type': 'text',
                        'placeholder': 'Иванович',
                        'required': false,
                    },
                    {
                        'name': 'email',
                        'shown_name': 'Электронная почта',
                        'type': 'email',
                        'placeholder': 'ivanov@mail.ru',
                        'required': true,
                    },
                    {
                        'name': 'login',
                        'shown_name': 'Логин',
                        'type': 'text',
                        'placeholder': 'ivanov',
                        'required': true,
                    },
                    {
                        'name': 'password',
                        'shown_name': 'Пароль',
                        'type': 'password',
                        'placeholder': '••••••••••••••••',
                        'required': true,
                    },
                    {
                        'name': 'password_verify',
                        'shown_name': 'Подтверждение пароля',
                        'type': 'password',
                        'placeholder': '••••••••••••••••',
                        'required': true,
                    },
                ],
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>

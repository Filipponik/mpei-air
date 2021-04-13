<template>
    <jet-action-section>
        <template #title>
            Удаление аккаунта
        </template>

        <template #description>
            Удаление Вашего аккаунта навсегда.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                В случае удаления Вашего аккаунта, ваши ресурсы и данные будут удалены навсегда. Перед удалением своего аккаунта, пожалуйста, загрузите данные или информацию, которую необходимо сохранить.
            </div>

            <div class="mt-5">
                <jet-danger-button @click="confirmUserDeletion">
                    Удалить аккаунт
                </jet-danger-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <jet-dialog-modal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    Удалить аккаунт
                </template>

                <template #content>
                    Вы уверены, что хотите удалить Ваш аккаунт?  В случае удаления Вашего аккаунта, ваши ресурсы и данные будут удалены навсегда. Пожалуйста, введите пароль, чтобы подвертить, что хотите удалить свой аккаунт.

                    <div class="mt-4">
                        <jet-input type="password" class="mt-1 block w-3/4" placeholder="Пароль"
                                    ref="password"
                                    v-model="form.password"
                                    @keyup.enter="deleteUser" />

                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Отмена
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Удалить аккаунт
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionSection,
            JetDangerButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingUserDeletion: false,

                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {
            confirmUserDeletion() {
                this.confirmingUserDeletion = true;

                setTimeout(() => this.$refs.password.focus(), 250)
            },

            deleteUser() {
                this.form.delete(route('current-user.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },

            closeModal() {
                this.confirmingUserDeletion = false

                this.form.reset()
            },
        },
    }
</script>

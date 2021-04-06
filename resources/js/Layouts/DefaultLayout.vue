<template>
    <slot name="header">
        <header-component :canLogin="true" :canRegister="true"/>
    </slot>
    
    <div class="container m-10 mx-auto px-4 sm:px-6 lg:px-8">
        <slot>NO CONTENT</slot>
    </div>
    <slot name="footer">
        <footer-component />
    </slot>
</template>

<script>
    import HeaderComponent from '@/Components/Header'
    import FooterComponent from '@/Components/Footer'

    export default {
        components: {
            HeaderComponent,
            FooterComponent,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>

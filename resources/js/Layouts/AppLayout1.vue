<template>
    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center select-none">
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0" href="/">
                LOGO
                <span class="ml-3 text-xl">NAME</span>
            </a>
            <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400 flex flex-wrap items-center text-base justify-center">
                <a href="#" class="mr-5 text-gray-500 hover:text-gray-700">Онлайн-табло</a>
                <a href="#" class="mr-5 text-gray-500 hover:text-gray-700">Онлайн-табло</a>
                <a href="#" class="mr-5 text-gray-500 hover:text-gray-700">Онлайн-табло</a>
                <a href="#" class="mr-5 text-gray-500 hover:text-gray-700">Онлайн-табло</a>
                <a href="#" class="mr-5 text-gray-500 hover:text-gray-700">Онлайн-табло</a>
            </nav>
            
            <!--<?if (isset($_SESSION['user_id'])) {?>
            <p class="inline-flex items-center border-0 py-1 px-3 mr-3 focus:outline-none rounded text-base mt-4 md:mt-0"><?=$_SESSION['fio']?></p>
            <a href="/profile/" class="border border-indigo-500 inline-flex items-center bg-gray-100 mr-3 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Профиль
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
            <a href="/?logout" class="border border-indigo-500 inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Выйти
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
            <?} else {?>
-->
            <a href="/authorization/" class="border border-indigo-500 inline-flex items-center bg-gray-100 border-0 py-1 px-3 mr-4 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Войти
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
            <a href="/registration/" class="border border-indigo-500 inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Зарегистрироваться
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>

        </div>
    </header>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
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

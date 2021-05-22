<template>
    <header class="container mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto">
                <div class="flex justify-between min-h-full items-center">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center h-16">
                            <inertia-link href="/">
                                <jet-application-mark class="block h-9 w-9" />
                            </inertia-link>
                        </div>
                        <!-- Navigation Links -->
                        <div class="hidden space-x-2 md:-my-px md:ml-3 md:flex text-center">
                            <jet-nav-link v-for="nav_element in navMenu" :href="route(nav_element.route_name)" :key="nav_element.name" :active="route().current(nav_element.route_name)">
                                {{ nav_element.shown_name }}
                            </jet-nav-link>
                        </div>
                    </div>
                    
                    
                    <jet-dropdown v-if="$page.props.user" class="hidden md:flex md:ml-6 my-2" align="right" width="48">
                        <template #trigger>
                            <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </button>

                            <span v-else class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ $page.props.user.name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Управление аккаунтом
                            </div>

                            <jet-dropdown-link :href="route('profile.show')">
                                Профиль
                            </jet-dropdown-link>

                            <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                API Токены
                            </jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <jet-dropdown-link as="button">
                                    Выйти
                                </jet-dropdown-link>
                            </form>
                        </template>
                    </jet-dropdown>
                    
                    <div v-else class="hidden md:flex md:ml-6 my-2">
                        <!-- Auth buttons -->
                        <div class="ml-0 relative flex flex-wrap">
                            <div v-for="button in authButtons" :key="button.name">
                                <inertia-link v-if="button.condition" :href="route(button.route_name)" :active="route().current(button.route_name)" class="border border-indigo-500 inline-flex items-center bg-gray-100 border-0 py-1 px-1 md:px-3 my-1 mx-2 focus:outline-none hover:bg-gray-200 rounded text-base">
                                    {{ button.shown_name }}
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </inertia-link>
                            </div>
                        </div>
                    </div>
                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center md:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Responsive menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="md:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link v-for="nav_element in navMenu" :href="route(nav_element.route_name)" :key="nav_element.name" :active="route().current(nav_element.route_name)">
                        {{ nav_element.shown_name }}
                    </jet-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div v-if="$page.props.user" class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                            <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                        </div>

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                            Профиль
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                            API Токены
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link>
                                Выйти
                            </jet-responsive-nav-link>
                        </form>
                    </div>
                </div>
                <div v-else class="mt-3 space-y-1">
                    <div v-for="button in authButtons" :key="button.name">
                        <jet-responsive-nav-link v-if="button.condition" :href="route(button.route_name)" :active="route().current(button.route_name)">
                            {{ button.shown_name }}
                        </jet-responsive-nav-link>
                    </div>
                </div>
            </div>
        </nav>
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
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        },

        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink
        },

        data() {
            return {
                showingNavigationDropdown: false,
                navMenu: [
                    {
                        'name': 'flight',
                        'shown_name': 'Подобрать рейс',
                        'route_name': 'flight',
                    },
                    {
                        'name': 'live-board',
                        'shown_name': 'Онлайн-табло',
                        'route_name': 'liveboard',
                    },
                    {
                        'name': 'parking-zone',
                        'shown_name': 'Парковка',
                        'route_name': 'parkingzone',
                    },
                    {
                        'name': 'cafe-and-shops',
                        'shown_name': 'Кафе и магазины',
                        'route_name': 'cafeshops',
                    },
                    {
                        'name': 'how-to-get-to',
                        'shown_name': 'Как добраться',
                        'route_name': 'howtogetto',
                    },
                ],
                authButtons: [
                    {
                        'name': 'Login',
                        'shown_name': 'Войти',
                        'route_name': 'login',
                        'condition': this.canLogin,
                    },
                    {
                        'name': 'Register',
                        'shown_name': 'Зарегистрироваться',
                        'route_name': 'register',
                        'condition': this.canRegister,
                    },
                ],
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        },
    }
</script>

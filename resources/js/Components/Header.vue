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
                            <jet-nav-link v-for="nav_element in navMenu" :href="route(nav_element.route_name)"  :active="route().current(nav_element.route_name)">
                                {{ nav_element.shown_name }}
                            </jet-nav-link>
                        </div>
                    </div>
                    
                    
                    
                    <div class="hidden md:flex md:ml-6 my-2">
                        <!-- Auth buttons -->
                        <div class="ml-0 relative flex flex-wrap">
                            <div v-for="button in authButtons">
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
                    <jet-responsive-nav-link v-for="nav_element in navMenu" :href="route(nav_element.route_name)"  :active="route().current(nav_element.route_name)">
                        {{ nav_element.shown_name }}
                    </jet-responsive-nav-link>
                </div>
                <div class="mt-3 space-y-1">
                    <div v-for="button in authButtons">
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
    import Header from '@/Components/Header'
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
                        'name': 'live-board',
                        'shown_name': 'Онлайн-табло',
                        'route_name': 'liveboard',
                    },
                    {
                        'name': 'flight',
                        'shown_name': 'Рейсы',
                        'route_name': 'flight',
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
    }
</script>

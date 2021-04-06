<template>
    <footer class="text-gray-600 body-font select-none">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center sm:flex-row flex-col">
            <inertia-link class="text-center flex title-font font-medium items-center md:justify-start justify-center text-gray-900" href="/">
                <jet-application-mark class="block h-9 w-9" />
                <span class="mx-3 text-lg">MPEIAir | Продажа авиабилетов</span>
            </inertia-link>
            <p class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400 flex flex-wrap items-center text-base justify-center">© 2021 МЭИ
                <a href="https://mpei.ru/" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">@mpei</a>
            </p>
        </div>
    </footer>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'

    export default {
        components: {
            JetApplicationMark
        }
    }
</script>

<template>
    <div class="flex flex-wrap">
        <a v-for="link in pages.links"
        class="my-1 sm:my-2 mr-1 sm:mr-2 inline p-1 sm:p-2 border rounded cursor-pointer select-none"
        :class="link.active ? 'border-indigo-500': 'hover:border-indigo-300'"
        @click="$emit('clickedPagination', {url: link.url, label: link.label})">
            {{ link.label }}
        </a>
    </div>
</template>

<script>    
    export default {
        props: ['pages'],
        data() {
            return {

            };
        },

        mounted() {
        },

        methods: {
        }

    }
</script>
<template>
    <div>
        <div v-for="link in pages.links">
            <a class="inline mr-1 sm:mr-2 p-1 sm:p-2 border rounded cursor-pointer select-none"
            :class="link.active ? 'border-indigo-500': 'hover:border-indigo-300'"
            @click="$emit('clickedPagination', {url: link.url, label: link.label})">
                {{ link.label }}
            </a>
        </div>
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
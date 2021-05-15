<template>
    <div class="mb-5 md:mb-2">
        <h1 v-if="title" class="text-xl md:text-2xl my-2"> {{ title }}</h1>
        <slot></slot>
    </div>
</template>
<script>

    export default {
        props: ['title',],

        components: {

        },

        data() {
            return {
            }
        },

        mounted() {
        },

        methods: {
            dump: function(info) {
                console.log(info)
            }
        }
    }
</script>

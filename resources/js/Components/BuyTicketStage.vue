<template>
    <div class="mb-5 md:mb-2">
        <slot name="header">
            <h1 class="text-8xl"></h1>
        </slot>
        <slot></slot>
    </div>
</template>
<script>

    export default {
        props: ['',],

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

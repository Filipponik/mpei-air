<template>
    <layout>
    
    </layout>
</template>
<script>
    import Layout from '@/Layouts/DefaultLayout'

    export default {
        props: ['',],

        components: {
            Layout,

        },

        data() {
            return {
            }
        },

        mounted() {
            // TODO ИСТОРИЯ ПОКУПОК
        },

        methods: {
            dump: function(info) {
                console.log(info)
            }
        }
    }
</script>

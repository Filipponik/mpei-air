<template>
    <default-layout>
        <flight-card-block :flight="flightInfo" @click="request"/>
    </default-layout>
</template>


<script>
    import DefaultLayout from '@/Layouts/DefaultLayout'
    import FlightCardBlock from '@/Components/FlightCardBlock'

    export default {
        props: ['flight_code'],

        components: {
            DefaultLayout,
            FlightCardBlock,
        },
        
        data() {
            return {
                flightInfo: false,
            }
        },

        mounted() {
            axios({
                method: 'GET',
                url: '/api/flights/' + this.flight_code
            }).then((response) => {
                this.flightInfo = response.data;
            });
        },

        methods: {
            request: function(info) {
            }
        }
    }
</script>

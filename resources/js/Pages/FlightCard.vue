<template>
    <default-layout>
        <div class="flex flex-wrap items-center justify-center align-centermt-5 md:mt-0 w-full">
            <div class="w-full sm:w-1/2">
                <flight-card-block :flight="flightInfo" :isFromList="false" />
            </div>
        </div>
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
        }
    }
</script>

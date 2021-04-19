<template>
    <default-layout>
        <div class="flex flex-row flex-wrap justify-between">
            <div class="flex-grow my-2 mx-1 lg:m-5">
                <search-block />
            </div>
            <div v-if="flightInfo" class="flex-grow w-full lg:w-1/2 my-2 mx-1 lg:m-5">
                <div v-for="flight in flightInfo">
                    <div class="mb-5">
                        <flight-block :flight="flight" />
                    </div>
                </div>
            </div>
        </div>
    </default-layout>
</template>

<script>
    import DefaultLayout from '@/Layouts/DefaultLayout'
    import FlightBlock from '@/Components/FlightBlock'
    import SearchBlock from '@/Components/SearchBlock'
    
    export default {
        components: {
            DefaultLayout,
            FlightBlock,
            SearchBlock
        },

        data() {
            return {
                flightInfo: false,
            };
        },

        mounted() {
            axios.get('/api/flights').then((response) => {
                this.flightInfo = response.data;
            });
        },

        methods: {

        }

    }
</script>
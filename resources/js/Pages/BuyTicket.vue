<template>
    <default-layout>
        <div class="flex flex-wrap items-center justify-center align-centermt-5 md:mt-0 w-full">
            <div class="w-full sm:w-1/2">
                <flight-card-block :flight="flightInfo" :isFromList="false" :showButtons="false">
                    <p class="text-lg md:text-xl mt-3 text-indigo-600 select-none">Покупка билета ниже ↓</p>
                </flight-card-block>
                <div class="mt-2 md:mt-10 relative border border-indigo-500 w-full bg-gray-100 rounded-lg p-2 sm:p-8 inline-block ml-auto mr-auto shadow-xl">
                    <buy-ticket-stage v-if="currentStage >= 1">
                        <template #header>
                            123123
                        </template>
                        stage1
                    </buy-ticket-stage>
                    <buy-ticket-stage v-if="currentStage >= 2">stage2</buy-ticket-stage>
                    <buy-ticket-stage v-if="currentStage >= 3">stage3</buy-ticket-stage>
                    <buy-ticket-stage v-if="currentStage >= 4">stage4</buy-ticket-stage>
                </div>
                <p class="text-3xl border rounded" @click="currentStage++">Stage++</p>
            </div>
            

        </div>
    </default-layout>
</template>
<script>
    import DefaultLayout from '@/Layouts/DefaultLayout'
    import FlightCardBlock from '@/Components/FlightCardBlock'
    import BuyTicketStage from '@/Components/BuyTicketStage'

    export default {
        props: ['flight_code',],

        components: {
            DefaultLayout,
            FlightCardBlock,
            BuyTicketStage,

        },

        data() {
            return {
                flightInfo: false,
                currentStage: 1,
            }
        },

        mounted() {
            axios({
                method: 'GET',
                url: '/api/flights/' + this.flight_code
            }).then((response) => {
                this.flightInfo = response.data;
            });
            document.title = "Купить билет на рейс "+ this.flight_code
        },

        methods: {
            dump: function(info) {
                console.log(info)
            }
        }
    }
</script>

<template>
    <default-layout>
        <div class="flex flex-wrap items-center justify-center align-centermt-5 md:mt-0 w-full">
            <div class="w-full sm:w-1/2">
                <flight-card-block :flight="flightInfo" :isFromList="false" :showButtons="false">
                    <p class="text-lg md:text-xl mt-3 text-indigo-600 select-none">Покупка билета ниже ↓</p>
                </flight-card-block>
                <div class="mt-2 md:mt-10 relative border border-indigo-500 w-full bg-gray-100 rounded-lg p-2 sm:p-8 inline-block ml-auto mr-auto shadow-xl">
                    <buy-ticket-stage :title="'Кто полетит'" v-if="currentStage >= 1">
                        <input type="radio" id="me" name="passenger" v-model="passengerType" value="me">
                        <label class="ml-2" for="me">Я</label><br>

                        <input type="radio" id="another_person" name="passenger" v-model="passengerType" value="another">
                        <label class="ml-2" for="another_person">Другой человек</label>

                        <div v-show="passengerType === 'another'" class="mt-3 md:mt-2">
                            <h2 class="text-lg md:text-xl">Введите данные пассажира:</h2>
                            <p class="mt-2">Фамилия:</p>
                            <text-input :id="'fam'" :ph="'Иванов'" v-model="passenger.fam" class="w-full"/>

                            <p class="mt-2">Имя:</p>
                            <text-input :id="'im'" :ph="'Иван'" v-model="passenger.im" class="w-full"/>

                            <p class="mt-2">Отчество:</p>
                            <text-input :id="'otch'" :ph="'Иванович'" v-model="passenger.otch" class="w-full"/>

                            <p class="mt-2">Пол:</p>
                            <input type="radio" name="sex" id="male" v-model="passenger.sex">
                            <label class="mx-2" for="male">Мужской</label>
                            <input type="radio" name="sex" id="female" v-model="passenger.sex">
                            <label class="ml-2 mb-1" for="female">Женский</label>

                            <p class="mt-2">Дата рождения:</p>
                            <v-date-picker v-model="passenger.date"
                                :max-date="new Date()">
                                <template v-slot="{ inputValue, inputEvents }">
                                    <text-input
                                    class="w-full"
                                    :id="'date'"
                                    :value="inputValue"
                                    :ph="'Дата рождения'"
                                    v-on="inputEvents" 
                                    />
                                </template>
                            </v-date-picker>
                        </div>
                    </buy-ticket-stage>
                    <buy-ticket-stage :title="'Выберите место'" v-if="currentStage >= 2">

                    </buy-ticket-stage>
                    <buy-ticket-stage :title="'Выберите дополнительные услуги'" v-if="currentStage >= 3">
                        
                    </buy-ticket-stage>
                    <buy-ticket-stage class="select-none" :title="'Выберите способ оплаты'" v-if="currentStage >= 4">
                            <input type="radio" name="payment_method" id="cash" v-model="payment_method">
                            <label class="mx-2" for="cash">Наличные при получении</label><br>
                            <input type="radio" name="payment_method" id="card" v-model="payment_method">
                            <label class="mx-2 mb-1" for="card">Картой онлайн</label><br>
                            <input type="radio" name="payment_method" id="gpay" v-model="payment_method">
                            <label class="ml-2 mb-1" for="gpay">Google Pay</label>
                    </buy-ticket-stage>
                    <buy-ticket-stage v-if="currentStage >= 5" :class="'mb-0'">
                        <jet-button @click="tryToBuyTicket">Купить билет</jet-button>
                    </buy-ticket-stage>
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
    import TextInput from '@/Components/TextInput'
    import JetButton from '@/Jetstream/Button'


    export default {
        props: ['flight_code',],

        components: {
            DefaultLayout,
            FlightCardBlock,
            BuyTicketStage,
            TextInput,
            JetButton,

        },

        data() {
            return {
                flightInfo: false,
                currentStage: 1,
                passengerType: false,
                passenger: {
                    im: '',
                    fam: '',
                    otch: '',
                    sex: '',
                    date: '',
                },
                payment_method: false
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

        watch: {
            passengerType() {
                this.checkPassenger()
            },
            passenger: {
                handler: function() {
                    this.checkPassenger()
                },
                deep: true
            },
        },

        methods: {
            checkPassenger: function() {
                if (this.passengerType === 'me') 
                {
                    this.currentStage = 2;
                    return true;
                }
                else if (this.passengerType === 'another') {
                    if (this.passenger.im.trim() == ''
                        || this.passenger.fam.trim() == ''
                        || this.passenger.otch.trim() == ''
                        || this.passenger.sex.trim() == ''
                        || (typeof this.passenger.date) !== 'object') {
                        this.currentStage = 1
                        return false
                    }
                    if (this.currentStage === 1)
                        this.currentStage = 2
                }
                else 
                    this.currentStage = 1
            },
            tryToBuyTicket: function(info) {
                axios({
                    method: 'POST',
                    url: '/api/flights/' + this.flight_code + '/buy'
                }).then((response) => {
                    console.log(response)
                });
            },
        }
    }
</script>

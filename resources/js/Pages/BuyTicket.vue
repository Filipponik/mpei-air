<template>
    <default-layout>
        <div @click="currentStage++" class="flex flex-wrap items-center justify-center align-centermt-5 md:mt-0 w-full">
            <div class="w-full sm:w-1/2">
                <!-- <flight-card-block :flight="flightInfo" :isFromList="false" :showButtons="false">
                    <p class="text-lg md:text-xl mt-3 text-indigo-600 select-none">Покупка билета ниже ↓</p>
                </flight-card-block> -->
                <div class="mt-2 md:mt-10 relative border border-indigo-500 w-full bg-gray-100 rounded-lg p-2 sm:p-8 inline-block ml-auto mr-auto shadow-xl">
                    <buy-ticket-stage :title="'Кто полетит'" v-if="currentStage >= 1">
                        <input type="radio" id="me" name="passenger" v-model="passengerType" value="me">
                        <label class="ml-2" for="me">Я</label><br>

                        <input type="radio" id="another" name="passenger" v-model="passengerType" value="another">
                        <label class="ml-2" for="another">Другой человек</label>

                        <div v-show="passengerType === 'another'" class="mt-3 md:mt-2">
                            <h2 class="text-lg md:text-xl">Введите данные пассажира:</h2>
                            <p class="mt-2">Фамилия:</p>
                            <text-input :id="'fam'" :ph="'Иванов'" v-model="passenger.fam" class="w-full"/>

                            <p class="mt-2">Имя:</p>
                            <text-input :id="'im'" :ph="'Иван'" v-model="passenger.im" class="w-full"/>

                            <p class="mt-2">Отчество:</p>
                            <text-input :id="'otch'" :ph="'Иванович'" v-model="passenger.otch" class="w-full"/>

                            <p class="mt-2">Пол:</p>
                            <input type="radio" name="sex" id="male" value="male" v-model="passenger.sex">
                            <label class="mx-2" for="male">Мужской</label>
                            <input type="radio" name="sex" id="female" value="female" v-model="passenger.sex">
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
                    
                    <buy-ticket-stage :title="'Выберите класс'" v-if="currentStage >= 2">
                        <div v-if="available_classes.econom">
                            <input type="radio" name="type_class" id="econom" value="econom" v-model="type_class">
                            <label class="mx-2" for="econom">Эконом</label>
                        </div>
                        <div v-if="available_classes.business">
                            <input type="radio" name="type_class" id="business" value="business" v-model="type_class">
                            <label class="mx-2" for="business">Бизнес</label><br>
                        </div>
                        <div v-if="available_classes.first">
                            <input type="radio" name="type_class" id="first" value="first" v-model="type_class">
                            <label class="mx-2" for="first">Первый</label>
                        </div>
                    </buy-ticket-stage>

                    <buy-ticket-stage :title="'Выберите место'" v-if="currentStage >= 3">
                        <div v-if="available_classes.econom && type_class == 'econom'">
                            <div class="flex flex-row justify-start w-full" v-for="i in flightInfo.plane.cols_econom" :key="i">
                                <div v-for="j in flightInfo.plane.seats_econom" :key="j">
                                    <div @click="select_seat(i, j)"
                                        class="w-10 text-xs text-center border rounded p-1 m-1"
                                        :class="get_seat_style(i, j)">{{ get_seat_name(i,j) }}</div>
                                </div><br>
                            </div>
                        </div>
                        <div v-if="available_classes.econom && type_class == 'business'">
                            <div class="flex flex-row justify-start w-full" v-for="i in flightInfo.plane.cols_econom" :key="i">
                                <div v-for="j in flightInfo.plane.seats_business" :key="j">
                                    <div @click="select_seat(i, j)"
                                        class="w-10 text-xs text-center border rounded p-1 m-1"
                                        :class="get_seat_style(i, j)">{{ get_seat_name(i,j) }}</div>
                                </div><br>
                            </div>
                        </div>
                        <div v-if="available_classes.econom && type_class == 'first'">
                            <div class="flex flex-row justify-start w-full" v-for="i in flightInfo.plane.cols_econom" :key="i">
                                <div v-for="j in flightInfo.plane.seats_first" :key="j">
                                    <div @click="select_seat(i, j)"
                                        class="w-10 text-xs text-center border rounded p-1 m-1"
                                        :class="get_seat_style(i, j)">{{ get_seat_name(i,j) }}</div>
                                </div><br>
                            </div>
                        </div>
                    </buy-ticket-stage>

                    <buy-ticket-stage :title="'Выберите дополнительные услуги'" v-if="currentStage >= 4">
                        
                    </buy-ticket-stage>

                    <buy-ticket-stage class="select-none" :title="'Выберите способ оплаты'" v-if="currentStage >= 5">
                        <!-- <input type="radio" name="payment_method" id="cash" value="cash" v-model="payment_method">
                        <label class="mx-2" for="cash">Наличные при получении</label><br> -->
                        <input type="radio" name="payment_method" id="card" value="card" v-model="payment_method">
                        <label class="mx-2 mb-1" for="card">Картой онлайн</label><br>
                        <input type="radio" name="payment_method" id="gpay" value="gpay" v-model="payment_method">
                        <label class="ml-2 mb-1" for="gpay">Google Pay</label>
                    </buy-ticket-stage>

                    <buy-ticket-stage v-if="currentStage >= 6" :class="'mb-0'">
                        <jet-button @click="tryToBuyTicket">Купить билет</jet-button>
                    </buy-ticket-stage>
                </div>
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
                seat_styles: {
                    selected: 'bg-indigo-200 hover:bg-indigo-200 border-indigo-600 cursor-pointer',
                    free: 'bg-white hover:bg-indigo-100 border-indigo-500 cursor-pointer',
                    locked: 'bg-gray-200 hover:bg-gray-200 border-gray-200 cursor-default',
                },
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
                payment_method: false,
                type_class: false,
                available_classes: {
                    econom: false,
                    business: false,
                    first: false,
                },
                selected_seat: {
                    col: false,
                    row: false
                },
                summary_cost: false,
                token: this.$page.props.user?.defaultToken,
            }
        },

        mounted() {
            axios({
                method: 'GET',
                url: '/api/flights/' + this.flight_code
            }).then((response) => {
                this.flightInfo = response.data;
                if (this.flightInfo.plane.cols_econom * this.flightInfo.plane.seats_econom > 0) 
                    this.available_classes.econom = true
                if (this.flightInfo.plane.cols_business * this.flightInfo.plane.seats_business > 0) 
                    this.available_classes.business = true
                if (this.flightInfo.plane.cols_first * this.flightInfo.plane.seats_first > 0) 
                    this.available_classes.first = true
            });
            document.title = "Купить билет на рейс "+ this.flight_code
        },

        watch: {
            passengerType() {
                this.payment_method = false
                this.type_class = false
                this.selected_seat = {
                    col: false,
                    row: false
                }
                if (this.checkPassenger() === true && this.currentStage >= 1)
                    this.currentStage = 2
                else 
                    this.currentStage = 1
            },
            passenger: {
                handler: function() {
                    if (this.checkPassenger() === true && this.currentStage === 1) 
                        this.currentStage = 2
                    else
                        this.currentStage = 1

                },
                deep: true
            },
            type_class() {
                if (this.check_class() === true && this.currentStage === 2)
                    this.currentStage = 3
                    
                this.selected_seat = {
                    col: false,
                    row: false
                }
            },
            selected_seat: {
                handler: function() {
                    if (this.selected_seat
                        && this.selected_seat.col != false
                        && this.selected_seat.row != false
                        && this.currentStage === 3)
                        this.currentStage = 4
                },
                deep: true
            }


        },

        methods: {
            get_seat_style: function(i, j) {
                if (this.selected_seat.row == i && this.selected_seat.col == j) {
                    return this.seat_styles.selected
                }
                // TODO Сделать проверку на доступность места
                if (true) {
                    return this.seat_styles.free
                }

                return this.seat_styles.locked
            },
            checkPassenger: function() {
                if (this.passengerType === 'me') 
                    return true;
                
                if (this.passengerType === 'another') {
                    if (this.passenger.im.trim() == ''
                        || this.passenger.fam.trim() == ''
                        || this.passenger.otch.trim() == ''
                        || this.passenger.sex.trim() == ''
                        || (typeof this.passenger.date) !== 'object') {
                        return false
                    }
                    return true
                }

                return false
            },

            check_class: function() {
                if (this.type_class !== 'econom' && this.type_class !== 'business' && this.type_class !== 'first')
                    return false
                if (this.type_class === 'econom' && this.available_classes.econom === false) 
                    return false
                if (this.type_class === 'business' && this.available_classes.business === false) 
                    return false
                if (this.type_class === 'first' && this.available_classes.first === false) 
                    return false

                return true
            },

            get_seat_name: function(seat, col) {
                return 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'[col-1] + seat
            },

            select_seat: function(seat, col) {
                this.selected_seat = {
                    col: col,
                    row: seat,
                }
            },

            tryToBuyTicket: function() {
                if (!this.token) {
                    alert('Необходимо авторизоваться или зарегистрироваться')
                    return false
                }
                axios({
                    method: 'POST',
                    url: '/api/tickets/buy',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + this.token
                    },
                    data: {
                        'flight_code': this.flight_code,
                        'passenger': this.passenger,
                        'passengerType': this.passengerType,
                        'type_class': this.type_class,
                        'selected_seat': this.selected_seat,
                        // TODO Добавить дополнительные услуги
                        'optional_services': this.flight_code,
                        // TODO ДОБАВИТЬ ЦЕНЫ
                        'cost': this.summary_cost,
                    }
                }).then((response) => {
                    console.log(response.data)
                });
            },
        }
    }
</script>

<template>
    <div v-if="flight !== false && hide === false">
        <div v-if="isFromList">
            <popup @close="closeCard">
                <div class="text-xl" title="Номер рейса">Код рейса: <span class="select-all">{{ flight.code }}</span></div>
                <div title="Авиакомпания">{{ flight.airline.name }}</div>
                <div class="text-gray-500">Текущий статус: {{ flight.status }}</div>
                <div class="border-b border-indigo-500 my-1 sm:my-2">Информация о вылете:</div>
                <div title="Дата вылета">Дата: {{ getDate(flight.date_from) }}</div>
                <div title="Время вылета">Время: {{ getTime(flight.date_from) }}</div>
                <div title="Страна вылета">Страна: {{ flight.airport_from.city.country.name }}</div>
                <div title="Город вылета">Город: {{ flight.airport_from.city.name }}</div>
                <div title="Аэропорт вылета">Аэропорт: {{ flight.airport_from.name }} <span class="text-gray-500">({{ flight.airport_from.code }})</span></div>
                
                <div class="border-b border-indigo-500 my-1 sm:my-2">Информация о прилете:</div>
                <div title="Дата прилета">Дата: {{ getDate(flight.date_to) }}</div>
                <div title="Время прилета">Время: {{ getTime(flight.date_to) }}</div>
                <div title="Страна прилета">Страна: {{ flight.airport_from.city.country.name }}</div>
                <div title="Город прилета">Город: {{ flight.airport_to.city.name }}</div>
                <div title="Аэропорт прилета">Аэропорт: {{ flight.airport_to.name }} <span class="text-gray-500">({{ flight.airport_to.code }})</span></div>

                <jet-button v-if="showButtons !== false" :class="'mt-5'" @click="redirectToBuy">Купить билет</jet-button>
                <slot></slot>
            </popup>
        </div>
        <div v-else>
            <div class="relative border border-indigo-500 w-full bg-gray-100 rounded-lg p-2 sm:p-8 inline-block ml-auto mr-auto shadow-xl">
                <div class="text-xl" title="Номер рейса">Код рейса: <span class="select-all">{{ flight.code }}</span></div>
                <div title="Авиакомпания">{{ flight.airline.name }}</div>
                <div class="text-gray-500">Текущий статус: {{ flight.status }}</div>
                <div class="border-b border-indigo-500 my-1 sm:my-2">Информация о вылете:</div>
                <div title="Дата вылета">Дата: {{ getDate(flight.date_from) }}</div>
                <div title="Время вылета">Время: {{ getTime(flight.date_from) }}</div>
                <div title="Страна вылета">Страна: {{ flight.airport_from.city.country.name }}</div>
                <div title="Город вылета">Город: {{ flight.airport_from.city.name }}</div>
                <div title="Аэропорт вылета">Аэропорт: {{ flight.airport_from.name }} <span class="text-gray-500">({{ flight.airport_from.code }})</span></div>
                
                <div class="border-b border-indigo-500 my-1 sm:my-2">Информация о прилете:</div>
                <div title="Дата прилета">Дата: {{ getDate(flight.date_to) }}</div>
                <div title="Время прилета">Время: {{ getTime(flight.date_to) }}</div>
                <div title="Страна прилета">Страна: {{ flight.airport_from.city.country.name }}</div>
                <div title="Город прилета">Город: {{ flight.airport_to.city.name }}</div>
                <div title="Аэропорт прилета">Аэропорт: {{ flight.airport_to.name }} <span class="text-gray-500">({{ flight.airport_to.code }})</span></div>
                <div v-if="showButtons !== false" class="absolute right-4 top-4 cursor-pointer">
                    <div
                    class="border border-indigo-200 bg-white rounded p-1"
                    @click="closeCard">
                        ✖
                    </div>
                </div>

                <jet-button v-if="showButtons !== false" :class="'mt-5'" @click="redirectToBuy">Купить билет</jet-button>
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script>
    import Popup from '@/Components/Popup'
    import JetButton from '@/Jetstream/Button'

    export default {
        props: ['flight', 'isFromList', 'showButtons'],
        components: {
            Popup,
            JetButton,

        },

        data() {
            return {
                hide: false,
            }
        },

        methods: {
            zeroIfNeeded: function(value) {
                return value < 10
                    ? '0' + value.toString()
                    : value.toString();
            },

            getTime: function(dateString) {
                let dateObj = new Date(dateString);
                let hours = this.zeroIfNeeded(dateObj.getHours());
                let minutes = this.zeroIfNeeded(dateObj.getMinutes());

                return hours + ':' + minutes;
            },

            getDate: function (dateString) {
                let dateObj = new Date(dateString);
                let day = this.zeroIfNeeded(dateObj.getDate());
                let month = this.zeroIfNeeded(dateObj.getMonth()+1);

                return day + '.' + month + '.' + dateObj.getFullYear();
            },

            closeCard: function() {
                if (this.isFromList == true)
                    this.$emit('close');
                else {
                    window.location.href = this.route('flight')
                }
            },

            redirectToBuy: function() {
                window.location.href = this.route('flight') + '/' + this.flight.code + '/buy'
            }
        }
    }
</script>

<template>
    <div class="flex flex-wrap justify-center align-center">
        <div v-if="flight !== false" class="relative border border-indigo-500 w-full sm:w-1/2 bg-gray-100 rounded-lg p-2 sm:p-8 flex flex-col md:ml-auto md:mr-auto w-full mt-5 md:mt-0">
            <div class="select-all text-xl" title="Номер рейса">Код рейса: {{ flight.code }}</div>
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
            <div class="absolute right-4 top-4"><a class="border border-indigo-200 bg-white rounded p-1">✖</a></div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['flight'],
        components: {
        },

        data() {
            return {
            }
        },

        mounted() {
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
                let month = this.zeroIfNeeded(dateObj.getMonth());

                return day + '.' + month + '.' + dateObj.getFullYear();
            }
        }
    }
</script>

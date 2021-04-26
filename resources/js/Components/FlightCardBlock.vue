<template>
    <!-- <div v-if="flight !== false && hide === false" class="relative border border-indigo-500 w-full bg-gray-100 rounded-lg p-2 sm:p-8 flex flex-col ml-auto mr-auto shadow-xl"> -->
        <div v-if="flight !== false && hide === false" :class="(isFromList) ? 'fixed z-10 inset-0 overflow-y-auto': ''">
            <div :class="(isFromList === true) ? 'flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0' : 'relative border border-indigo-500 w-full bg-gray-100 rounded-lg p-2 sm:p-8 flex flex-col ml-auto mr-auto shadow-xl'">
                <div v-if="isFromList" class="fixed inset-0 bg-white bg-opacity-75 transition-opacity"></div>
                <span v-if="isFromList" class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div :class="(isFromList === true) ? 'p-4 sm:p-8 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full' : ''">
                    <div class="text-xl" title="Номер рейса">Код рейса: <span class="select-all">{{ flight.code }}</span></div>
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
                    <div class="absolute right-4 top-4 cursor-pointer">
                        <div
                        class="border border-indigo-200 bg-white rounded p-1"
                        @click="closeCard">
                            ✖
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- </div> -->
</template>
<script>
    export default {
        props: ['flight', 'isFromList'],
        components: {
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
                let month = this.zeroIfNeeded(dateObj.getMonth());

                return day + '.' + month + '.' + dateObj.getFullYear();
            },

            closeCard: function() {
                if (this.isFromList == true)
                    this.$emit('close');
                else {
                    window.location.href = this.route('flight')
                }
            }
        }
    }
</script>

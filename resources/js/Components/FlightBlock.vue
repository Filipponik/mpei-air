<template>
    <div @click="selectedCard" class="cursor-pointer border rounded border-indigo-500 w-full px-1 py-3 flex flex-wrap sm:flex-nowrap justify-between bg-gray-100">
        <div class="mx-1 sm:mx-2 mb-2 sm:mb-0 w-full sm:w-1/5 flex sm:block flex-wrap sm:flex-nowrap border-b border-indigo-200 sm:border-b-0 items-center sm:items-start justify-between">
            <div class="text-lg sm:text-xl" title="Номер рейса">{{ flight.code }}</div>
            <div class="hidden sm:block text-xl sm:text-base" title="Номер рейса">{{ flight.airline.name }}</div>
            <div class="text-xs">Статус: {{ flight.status }}</div>
        </div>
        <div class="mx-1 sm:mx-2 break-normal flex-shrink w-2/5 sm:w-1/5">
            <div class="text-base" title="Дата вылета">{{ getDate(flight.date_from) }}</div>
            <div class="text-base" title="Время вылета">{{ getTime(flight.date_from) }}</div>
            <div class="text-xs text-gray-500" title="Аэропорт вылета">{{ flight.airport_from.name }} ({{ flight.airport_from.code }})</div>
            <div class="text-sm sm:text-base">{{ flight.airport_from.city.name }}</div>
        </div>
        <div class="mx-1 self-center text-xl sm:text-2xl md:text-3xl lg:text-4xl select-none">→</div>
        <div class="mx-1 sm:mx-2 break-normal flex-shrink w-2/5 sm:w-1/5 text-right">
            <div class="text-base" title="Дата прилета">{{ getDate(flight.date_to) }}</div>
            <div class="text-base" title="Время прилета">{{ getTime(flight.date_to) }}</div>
            <div class="text-xs text-gray-500" title="Аэропорт прилета">{{ flight.airport_to.name }} ({{ flight.airport_to.code }})</div>
            <div class="text-sm sm:text-base">{{ flight.airport_to.city.name }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['flight'],

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

            selectedCard: function() {
                this.$emit('selected', this.flight);
            }
        }
    }
</script>
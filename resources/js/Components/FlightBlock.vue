<template>
    <div class="border rounded border-indigo-500 w-full px-1 py-3 flex flex-wrap sm:flex-nowrap justify-between bg-gray-100">
        <div class="mx-1 sm:mx-2 mb-2 sm:mb-0 w-full sm:w-1/5 flex sm:block flex-wrap sm:flex-nowrap border-b border-indigo-200 sm:border-b-0 items-center sm:items-start justify-between">
            <div class="text-lg sm:text-xl select-all" title="Номер рейса">{{ flight.code }}</div>
            <div class="text-xs">Статус: {{ flight.status }}</div>
        </div>
        <div class="mx-1 sm:mx-2 break-normal flex-shrink w-2/5 sm:w-1/5">
            <div class="text-base" title="Дата вылета">20.20.20</div>
            <div class="text-base" title="Время вылета">18:43</div>
            <div class="text-xs text-gray-500" title="Аэропорт вылета">{{ flight.airport_from.name }} ({{ flight.airport_from.code }})</div>
            <div class="text-sm sm:text-base">{{ flight.airport_from.city.name }}</div>
        </div>
        <div class="mx-1 self-center text-xl sm:text-2xl md:text-3xl lg:text-4xl select-none">→</div>
        <div class="mx-1 sm:mx-2 break-normal flex-shrink w-2/5 sm:w-1/5 text-right">
            <div class="text-base" title="Дата прилета">20.20.20</div>
            <div class="text-base" title="Время прилета">18:43</div>
            <div class="text-xs text-gray-500" title="Аэропорт прилета">{{ flight.airport_to.name }} ({{ flight.airport_to.code }})</div>
            <div class="text-sm sm:text-base">{{ flight.airport_to.city.name }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['flight'],
        
        data() {
            return {
            }
        },

        mounted() {
        },

        methods: {
        }
    }
</script>
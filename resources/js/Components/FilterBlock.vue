<template>
    <div>
        <div class="mb-1 sm:mb-2">
            <label class="block" for="city_from">Из города</label>
            <text-input @update:modelValue="filtersSet" v-model="searchQuery.city_from" class="w-full" :id="'city_from'" :ph="'Город вылета'"/>
        </div>
        <div class="mb-1 sm:mb-2">
            <label class="block" for="city_to">В город</label>
            <text-input @update:modelValue="filtersSet" v-model="searchQuery.city_to" class="w-full" :id="'city_to'" :ph="'Город прилета'"/>
        </div>
        <div class="mb-1 sm:mb-2">
            <label class="block" for="date_from">Дата вылета</label>
            <v-date-picker v-model="searchQuery.date_from"
            :min-date="new Date('2000-01-01')"
            :max-date="new Date('2100-01-01')"
            @input="filtersSet">
                <template v-slot="{ inputValue, inputEvents }">
                    <text-input
                    class="w-full"
                    :id="'date_from'"
                    :value="inputValue"
                    :ph="'Дата вылета'"
                    v-on="inputEvents" 
                    @update:modelValue="filtersSet"
                    />
                </template>
            </v-date-picker>
        </div>
        <div class="mb-1 sm:mb-2">
            <label class="block" for="date_to">Дата прилета</label>
            <v-date-picker v-model="searchQuery.date_to"
            :min-date="new Date('2000-01-01')"
            :max-date="new Date('2100-01-01')">
                <template v-slot="{ inputValue, inputEvents }">
                    <text-input
                    class="w-full"
                    :id="'date_to'"
                    :value="inputValue"
                    :ph="'Дата прилета'"
                    v-on="inputEvents" 
                    @update:modelValue="filtersSet"
                    />
                </template>
            </v-date-picker>
        </div>
        <div class="mb-1 sm:mb-2">
            <label class="block" for="airport_from">Аэропорт вылета</label>
            <text-input @update:modelValue="filtersSet" v-model="searchQuery.airport_from" class="w-full" :id="'airport_from'" :ph="'Аэропорт вылета'"/>
        </div>
        <div class="mb-1 sm:mb-2">
            <label class="block" for="airport_to">Аэропорт прилета</label>
            <text-input @update:modelValue="filtersSet" v-model="searchQuery.airport_to" class="w-full" :id="'airport_to'" :ph="'Аэропорт прилета'"/>
        </div>
    </div>
</template>

<script>
    import TextInput from '@/Components/TextInput'
    
    export default {
        props: ['searchQuery'],

        components: {
            TextInput,
        },

        data: function () {
            return {
            }
        },

        methods: {
            filtersSet: function() {
                this.$emit('filtersSet', this.searchQuery);
            },
        }
    }
</script>
<template>
    <div class="p-5 border rounded border-indigo-500">
        <div class="mb-2">Поиск по коду рейса:</div>
        <div>
            <text-input v-model="searchQuery.code" class="w-full" :id="'search'" :ph="'Код рейса...'" />
        </div>
        <div class="flex justify-between">
            <jet-button @click="search" class="my-2 mr-2 sm:mr:0">Искать</jet-button>
            <jet-button @click="showFilters = !showFilters" class="my-2">Фильтры</jet-button>
        </div>
        <div v-show="showFilters">
            <filter-block @filtersSet="setQuery($event)" :searchQuery="searchQuery"/>
        </div>
    </div>
    <div v-if="showNotification" class="mt-2 sm:mt-3 p-5 border rounded border-indigo-500 break-words">
        <p>Были использованы Ваши последние фильтры. Убрать их?</p>
        <div class="flex justify-between">
            <jet-button @click="clearFilters" class="my-2 mr-2 sm:mr:0">Убрать</jet-button>
            <jet-button @click="showNotification = !showNotification" class="my-2">Оставить</jet-button>
        </div>
    </div>
    
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import FilterBlock from '@/Components/FilterBlock'
    import TextInput from '@/Components/TextInput'
    
    export default {
        components: {
            JetButton,
            FilterBlock,
            TextInput,
        },

        data: function () {
            return {
                showFilters: false,
                emptySearch: {
                    code: '',
                    city_from: '',
                    city_to: '',
                    date_from: '',
                    date_to: '',
                    airport_from: '',
                    airport_to: '',
                    query: '',
                    status: 'Запланирован',
                    page: 1,
                },
                searchQuery: {
                    code: '',
                    city_from: '',
                    city_to: '',
                    date_from: '',
                    date_to: '',
                    airport_from: '',
                    airport_to: '',
                    query: '',
                    status: 'Запланирован',
                    page: 1,
                },
                filters: false,
                showNotification: false,
            }
        },

        mounted() {
            if (localStorage.flightSearchOptions) {
                this.filters = JSON.parse(localStorage.flightSearchOptions)
                this.showNotification = true;
                if (this.filters) 
                    this.searchQuery = this.filters
            }
        },

        methods: {
            search: function() {          
                delete this.searchQuery.page;
                this.$emit('search', this.searchQuery);
            },
            
            setQuery: function(filterInfo) {
                let q = this.searchQuery.query;
                this.searchQuery = filterInfo;
                this.searchQuery.query = q;
            },

            clearFilters: function () {
                this.showNotification = false;
                this.$emit('clearFilters');
                this.searchQuery = this.emptySearch;
            }
        }

    }
</script>
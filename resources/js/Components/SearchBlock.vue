<template>
    <div class="p-5 border rounded border-indigo-500">
        <div class="mb-2">Поиск</div>
        <div>
            <text-input v-model="searchQuery.query" class="w-full" :id="'search'" :ph="'Поиск...'" />
        </div>
        <div class="flex justify-between">
            <jet-button @click="search" class="my-2 mr-2 sm:mr:0">Искать</jet-button>
            <jet-button @click="showFilters = !showFilters" class="my-2">Фильтры</jet-button>
        </div>
        <div v-show="showFilters">
            <filter-block @filtersSet="setQuery($event)"/>
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
                searchQuery: {
                    query: '',
                    code: '',
                    city_from: '',
                    city_to: '',
                    date_from: '',
                    date_to: '',
                    airport_from: '',
                    airport_to: '',
                },
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
                // console.log(this.searchQuery);
            }
        }

    }
</script>
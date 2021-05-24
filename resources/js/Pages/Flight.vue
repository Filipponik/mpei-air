<template>
    <default-layout>
        <div class="relative">
            <div v-if="showCard && selectedCard" class="absolute z-2 w-full mx-auto">
                <div v-if="showCard && selectedCard" class="flex flex-wrap items-center justify-center align-center mt-5 md:mt-0 w-full">
                    <div class="w-full sm:w-1/2">
                        <flight-card-block v-if="flightInfo" :flight="selectedCard" :isFromList="true" @close="showCard = false"/>
                    </div>
                </div>
            </div>

            <div class="flex flex-row flex-wrap justify-between">
                <div class="flex-shrink w-full md:w-min my-2 mx-1 lg:m-5">
                    <search-block @clearFilters="clearFilters" @search="changeSearchOptions($event)" />
                </div>
                <div v-if="flightInfo" class="flex-grow w-full sm:w-1/2 my-2 mx-1 lg:m-5">
                    <div v-for="flight in flightInfo.data" :key="flight.code">
                        <div class="mb-5">
                            <flight-block :flight="flight" @selected="openCard($event)"/>
                        </div>
                    </div>
                    <pagination-block class="p-1 sm:p-2 mt-2 flex text-xs sm:text-base justify-center" @clickedPagination="clickedPagination($event)" :pages="flightInfo"/>
                </div>
            </div>
        </div>
    </default-layout>
</template>

<script>
    import DefaultLayout from '@/Layouts/DefaultLayout'
    import FlightBlock from '@/Components/FlightBlock'
    import SearchBlock from '@/Components/SearchBlock'
    import PaginationBlock from '@/Components/PaginationBlock'
    import FlightCardBlock from '@/Components/FlightCardBlock'
    
    export default {
        components: {
            DefaultLayout,
            FlightBlock,
            SearchBlock,
            PaginationBlock,
            FlightCardBlock
        },

        data() {
            return {
                flightInfo: false,
                searchOptions: {},
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
                showCard: false,
                selectedCard: false,
            }
        },

        mounted() {
            if (localStorage?.flightSearchOptions) {
                this.searchOptions = JSON.parse(localStorage.flightSearchOptions)
            }
            this.request('/api/flights', Object.assign({'status': 'Запланирован'}, this.searchOptions))
            
            document.title = "Поиск рейсов"
        },

        methods: {
            request: function (url, content) {
                axios({
                    method: 'GET',
                    url: url,
                    params: content,
                }).then((response) => {
                    this.flightInfo = response.data;
                });
            },

            changeSearchOptions: function (val) {
                this.searchOptions = val;
                localStorage.flightSearchOptions = JSON.stringify(val);
                if (JSON.stringify(this.searchOptions) === JSON.stringify(this.emptySearch)) {
                    this.request('/api/flights', {'status': 'Запланирован'});
                    delete localStorage.flightSearchOptions;
                }
                else {
                    this.request('/api/flights', Object.assign({'status': 'Запланирован'}, this.searchOptions));
                }
            },

            clickedPagination: function (page) {
                if (page.url != null && page.label != this.flightInfo.current_page) {
                    this.searchOptions.page = page.label;
                    this.changeSearchOptions(this.searchOptions);
                    scrollTo(0,0);
                }
            },

            openCard: function (params) {
                this.showCard = true;
                this.selectedCard = params;
            },

            clearFilters: function () {
                this.changeSearchOptions(Object.assign({}, this.emptySearch));
            }
        }

    }
</script>

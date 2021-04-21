<template>
    <default-layout>
        <div class="flex flex-row flex-wrap justify-between">
            <div class="flex-grow lg:flex-grow-0 my-2 mx-1 lg:m-5">
                <search-block @search="changeSearchOptions($event)" />
            </div>
            <div v-if="flightInfo" class="flex-grow w-full lg:w-1/2 my-2 mx-1 lg:m-5">
                <div v-for="flight in flightInfo.data">
                    <div class="mb-5">
                        <flight-block :flight="flight" />
                    </div>
                </div>
                <pagination-block class="p-1 sm:p-2 mt-2 flex text-xs sm:text-base justify-center" @clickedPagination="clickedPagination($event)" :pages="flightInfo"/>
            </div>
        </div>
    </default-layout>
</template>

<script>
    import DefaultLayout from '@/Layouts/DefaultLayout'
    import FlightBlock from '@/Components/FlightBlock'
    import SearchBlock from '@/Components/SearchBlock'
    import PaginationBlock from '@/Components/PaginationBlock'
    
    export default {
        components: {
            DefaultLayout,
            FlightBlock,
            SearchBlock,
            PaginationBlock
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
                    page: 1,
                }
            };
        },

        mounted() {
            if (localStorage.flightSearchOptions) {
                this.searchOptions = JSON.parse(localStorage.flightSearchOptions)
                console.log(this.searchOptions)
            }
            this.request('/api/flights/', this.searchOptions)
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
                console.log(val);
                this.searchOptions = val;
                localStorage.flightSearchOptions = JSON.stringify(val);
                if (JSON.stringify(this.searchOptions) === JSON.stringify(this.emptySearch)) {
                    this.request('/api/flights/');
                }
                else
                    this.request('/api/flights/', this.searchOptions);
            },

            clickedPagination: function (page) {
                if (page.url != null && page.label != this.flightInfo.current_page)
                {
                    this.searchOptions.page = page.label;
                    this.changeSearchOptions(this.searchOptions);
                    // if (JSON.stringify(this.searchOptions) === JSON.stringify(this.emptySearch))
                    //     this.request(page.url);
                    // else {
                    //     this.request('/api/flights/', this.searchOptions);
                    // }

                    // this.request(page.url);
                }
            }
        }

    }
</script>
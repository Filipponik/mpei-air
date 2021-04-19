<template>
    <div class="p-5 border rounded border-indigo-500">
        <div class="mb-2">Поиск</div>
        <div>
            <input class="bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" type="text" placeholder="Поиск..." />
        </div>
        <div>
            <jet-button v-if="showFilters" class="my-2 mr-2 sm:mr:0">Искать</jet-button>
            <jet-button @click="changeFilters" class="my-2">Фильтры</jet-button>
        </div>
    </div>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    
    export default {
        components: {
            JetButton,
        },

        data() {
            showFilters: false
        },

        methods: {
            changeFilters: function() {
                this.showFilters = true;
            }
        }

    }
</script>
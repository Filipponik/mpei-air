<template>
    <layout>
        <popup @close="details = false" v-if="details">
            <div class="text-xl mb-2" title="E-Mail">E-Mail: <a class="text-indigo-600" :href="'mailto:' + details.email">{{ details.email }}</a></div>
            <div class="text-lg mb-1" title="Имя">Имя: <span class="select-all">{{ details.name }}</span></div>
            <div class="text-base mb-1" title="Сообщение">Сообщение: {{ details.message }}</div>
            <div class="text-base mb-2" title="Сообщение">Статус: {{ get_status(details.status) }}</div>
            <jet-button @click="set_next_status(details.status)" class="text-base"> {{ get_next_status(details.status) }} </jet-button>
        </popup>
        <div class="flex flex-row flex-wrap justify-between">
            <div class="mb-3">
                <h2 class="text-lg">Статус запроса:</h2>
                <div v-for="(status, key) in statuses" :key="key">
                    <input class="mr-2 md:mr-3" type="radio" :value="key" :id="key" name="selected_status" v-model="selected_status"/>
                    <label :for="key"> {{ status }} </label>
                </div>
            </div>
            <div>
                <jet-button @click="request({status: selected_status}, 'get')">Обновить</jet-button>
            </div>
        </div>

        <div class="w-full" v-if="data?.data?.length > 0">
            <table class="w-full text-center align-middle">
                <tr class="text-indigo-600 border-b border-indigo-500">
                    <th class="hidden md:table-cell p-2 mb-1 text-left">ID</th>
                    <th class="hidden md:table-cell p-2 mb-2">Имя</th>
                    <th class="p-2 mb-2">E-Mail</th>
                    <th class="p-2 mb-2">Сообщение</th>
                    <th class="p-2 mb-2">Статус</th>
                </tr>
                <tr @click="details = dat" v-for="(dat, i) in data.data" :key="i" class="cursor-pointer border-b border-indigo-500 hover:bg-indigo-100">
                    <td class="hidden md:table-cell p-2 mb-1 text-left border-r border-indigo-500">{{ dat.id }}</td>
                    <td class="hidden md:table-cell p-2 mb-2">{{ dat.name }}</td>
                    <td class="p-2 mb-2">{{ dat.email }}</td>
                    <td class="p-2 mb-2">{{ cutText(dat.message, 50) }}</td>
                    <td class="p-2 mb-2">{{ get_status(dat.status) }}</td>
                </tr>
            </table>
        </div>
        
        <div v-else>
            <h1 class="mx-auto my-3 text-2xl p-2 md:p-3 text-center">Не найдено запросов пользователей со статусом "{{ get_status(selected_status) }}"</h1>
        </div>
    </layout>
</template>
<script>
    import Layout from '@/Layouts/DefaultLayout'
    import Popup from '@/Components/Popup'
    import JetButton from '@/Jetstream/Button'

    export default {
        props: ['',],

        components: {
            Layout,
            Popup,
            JetButton
        },

        data() {
            return {
                data: false,
                details: false,
                statuses: {
                    new: 'Новый',
                    inprogress: 'В работе',
                    closed: 'Закрыт',
                },
                selected_status: 'new',
            }
        },

        mounted() {
            document.title = 'Запросы через форму обратной связи'
            this.request({'status': this.selected_status}, 'get')
        },

        watch: {
            selected_status: function() {
                this.request({status: this.selected_status}, 'get')
            },

            details: {
                handler: function() {
                    this.request({status: this.selected_status}, 'get')
                },
                deep: true
            }
        },

        methods: {
            request: function(params, type) {
                if (type == 'get') {
                    axios({
                        method: 'GET',
                        url: '/api/support/list',
                        headers: {
                            'Authorization': 'Bearer ' + this.$page.props?.user?.defaultToken,
                        },
                        params: params
                    }).then((result) => {
                        this.data = result.data
                    }).catch((err) => {
                        console.log(err)
                    });
                }
                else if (type == 'update') {
                    axios({
                        method: 'POST',
                        url: '/api/support/update',
                        headers: {
                            'Authorization': 'Bearer ' + this.$page.props?.user?.defaultToken,
                        },
                        data: params
                    }).then((result) => {
                        this.details = result.data 
                    }).catch((err) => {
                        console.log(err)
                    });
                }
    
            },

            cutText: function(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            },

            set_next_status: function(value) {
                let new_status = false
                switch(value) {
                    case 'new':
                        new_status = 'inprogress'
                        break
                    case 'inprogress':
                        new_status = 'closed'
                        break
                    case 'closed':
                        new_status = 'inprogress'
                        break
                }
                this.request({
                    id: this.details.id,
                    status: new_status
                }, 'update')
            },

            get_status: function(value) {
                return (this.statuses[value]) ? (this.statuses[value]) : 'Неизвестно'
            },

            get_next_status: function(value) {
                switch(value) {
                    case 'new':
                        return 'В работу'
                    case 'inprogress':
                        return 'Закрыть'
                    case 'closed':
                        return 'Вернуть в работу'
                }
            },
        }
    }
</script>

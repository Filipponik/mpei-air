<template>
    <layout>
        <popup @close="details = false" v-if="details">
            <p class="text-xl mb-2">Заказ #{{details.id}}</p>
            <p class="text-xl mb-2">Дата {{getDateTime(details.created_at)}}</p>
            <p class="text-xl mb-2 border-b border-indigo-500 text-indigo-600">Стоимость {{details.cost}} ₽</p>
            <div v-if="details.tickets.length > 0">
                <div class="text-xl mb-2">Билеты: </div>
                <div class="border-b border-indigo-500 p-2" v-for="tick in details.tickets" :key="tick.id">
                    <p class="text-base mb-1"> ФИО пассажира: {{tick.person.fam + ' ' +tick.person.im + ' ' + tick.person.otch}} </p>
                    <p class="text-lg mb-1"> {{getClass(tick.class)}}, место {{get_seat_name(tick.row, tick.col)}} </p>
                    <div v-if="tick.services?.length > 0">Дополнительные услуги:
                        <div v-for="(service, key) in tick.services" :key="key">
                        <p class="text-base mb-1"> {{key + 1}}. {{ service.name }} </p>
                        <p class="text-base mb- text-indigo-600"> {{ service.cost }} ₽ </p>
                        </div>
                    </div>
                    <p v-else class="text-base mb-2">Дополнительных услуг не выбрано.</p>
                </div>
            </div>
            <div class="text-base mb-2"></div>
        </popup>

        <div class="w-full" v-if="data?.data?.length > 0">
            <table class="w-full text-center align-middle">
                <tr class="text-indigo-600 border-b border-indigo-500">
                    <th class="hidden md:table-cell p-2 mb-1 text-left">Номер заказа</th>
                    <th class="p-2 mb-2">Дата заказа</th>
                    <th class="p-2 mb-2">Кол-во билетов</th>
                    <th class="p-2 mb-2">Кол-во доп. услуг</th>
                    <th class="p-2 mb-2">Сумма</th>
                </tr>
                <tr @click="details = dat" v-for="(dat, i) in data.data" :key="i" class="cursor-pointer border-b border-indigo-500 hover:bg-indigo-100">
                    <td class="hidden md:table-cell p-2 mb-1 text-left">#{{ dat.id }}</td>
                    <td class="p-2 mb-2">{{ getDateTime(dat.created_at) }}</td>
                    <td class="p-2 mb-2">{{ dat?.tickets?.length }}</td>
                    <td class="p-2 mb-2">{{ service_count(dat?.tickets) }}</td>
                    <td class="p-2 mb-2">{{ dat?.cost }} ₽</td>
                </tr>
            </table>
        </div>
        
        <div v-else>
            <h1 class="mx-auto my-3 text-2xl p-2 md:p-3 text-center">Прошлые покупки не найдены</h1>
        </div>
    </layout>
</template>
<script>
    import Layout from '@/Layouts/DefaultLayout'
    import Popup from '@/Components/Popup'

    export default {
        props: ['',],

        components: {
            Layout,
            Popup

        },

        data() {
            return {
                data: false,
                details:false,
            }
        },

        mounted() {
            document.title = 'История покупок'
            axios({
                method: 'GET',
                url: '/api/buy-history',
                params: {
                    
                },
                headers: {
                    'Authorization': 'Bearer ' + this.$page.props?.user?.defaultToken,
                }
            }).then((result) => {
                this.data = result.data
            }).catch((err) => {
                console.log(err)
            });
        },

        methods: {
            get_seat_name: function(seat, col) {
                return 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'[col-1] + seat
            },
            zeroIfNeeded: function(value) {
                return value < 10
                    ? '0' + value.toString()
                    : value.toString();
            },
            getDateTime: function(date) {
                let dateObj = new Date(date)
                let day = this.zeroIfNeeded(dateObj.getDate())
                let month = this.zeroIfNeeded(dateObj.getMonth()+1)
                let hours = this.zeroIfNeeded(dateObj.getHours())
                let minutes = this.zeroIfNeeded(dateObj.getMinutes())

                return day + '.' + month + '.' + dateObj.getFullYear() + ' ' + hours + ':' + minutes

            },
            getClass: function(type_class) {
                switch (type_class) {
                    case 'econom':
                        return 'Эконом-класс'
                    case 'business':
                        return 'Бизнес-класс'
                    case 'first':
                        return 'Первый класс'
                }
            },
            service_count: function(tickets) {
                let arr = []
                arr = tickets.map(function name(ticket) {
                    return (ticket?.services?.length > 0) ? ticket?.services?.length : 0
                })
                let sum = 0
                for (let index = 0; index < arr.length; index++) {
                    const element = arr[index];
                    sum += element
                }
                return sum;
            },
        }
    }
</script>

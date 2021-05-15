require('./bootstrap');

// Import modules...
import 'es6-promise/auto'
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import VCalendar from 'v-calendar';
import store from './Store'

const el = document.getElementById('app');


const app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
    
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .use(VCalendar, {})
    .use(store)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });

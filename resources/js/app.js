// import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy'; // <-- 1. Impor ZiggyVue


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        // PASTIKAN ANDA MENGGUNAKAN 'return' DAN '.use(plugin)'
        return createApp({ render: () => h(App, props) })
            .use(plugin) // <-- BARIS INI SANGAT PENTING DAN KEMUNGKINAN HILANG
            .use(ZiggyVue) // <-- 2. Gunakan pluginnya di sin
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
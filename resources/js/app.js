import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createRouter, createWebHistory } from 'vue-router'; // Import Vue Router

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
library.add(fas);
import { fab } from '@fortawesome/free-brands-svg-icons';
library.add(fab);
import { far } from '@fortawesome/free-regular-svg-icons';
library.add(far);
import { dom } from "@fortawesome/fontawesome-svg-core";
dom.watch();

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Define your routes
const routes = [
    { path: '/manager/dashboard', component: () => import('./Pages/Manager/Dashboard.vue') },
    { path: '/manager/employees/', component: () => import('./Pages/Manager/Employees/Index.vue') },
    // { path: '/manager/employees/create', component: () => import('./Pages/Manager/Employees/Create.vue') },
    { path: '/manager/managers/', component: () => import('./Pages/Manager/Managers/Index.vue') },
    { path: '/manager/overtime_requests/', component: () => import('./Pages/Manager/OvertimeRequests/Index.vue') },
    { path: '/manager/overtime_approvals/', component: () => import('./Pages/Manager/OvertimeApprovals/Index.vue') },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(router)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

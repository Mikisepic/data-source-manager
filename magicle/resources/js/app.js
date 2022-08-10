import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

import AppLayout from './layouts/AppLayout.vue';
import { Plugins } from './plugins';
import { Router } from './router';

createApp(AppLayout).use(Router).use(Plugins).mount('#app');

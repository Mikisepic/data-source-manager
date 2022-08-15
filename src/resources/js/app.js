import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';

import AppLayout from './layouts/AppLayout.vue';
import { Plugins } from './plugins';
import { Router } from './router';

window.Alpine = Alpine;

Alpine.start();

createApp(AppLayout).use(Router).use(Plugins).mount('#app');

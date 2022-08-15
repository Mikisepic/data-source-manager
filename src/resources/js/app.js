import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';

window.Alpine = Alpine;

Alpine.start();

import AppLayout from './layouts/AppLayout.vue';
import { Plugins } from './plugins';
import { Router } from './router';

createApp(AppLayout).use(Router).use(Plugins).mount('#app');

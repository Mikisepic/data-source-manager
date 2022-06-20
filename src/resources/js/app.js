require('./bootstrap');

import { createApp } from 'vue';

import AppLayout from './layouts/AppLayout';
import { Plugins } from './plugins';
import { Router } from './router';

createApp(AppLayout).use(Router).use(Plugins).mount('#app');

require('./bootstrap');

require('alpinejs');

import { createApp } from 'vue';
import router from './router'

import CargoTypesIndex from './components/cargoTypes/CargoTypesIndex.vue';

createApp({
    components: {
        CargoTypesIndex
    }
}).use(router).mount('#app')

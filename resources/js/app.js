require('./bootstrap');

require('alpinejs');

import { createApp } from 'vue';
import router from './router'

import CompaniesIndex from './components/companies/CompaniesIndex.vue';
import CargoTypesIndex from './components/cargoTypes/CargoTypesIndex.vue';

createApp({
    components: {
        CompaniesIndex,
        CargoTypesIndex
    }
}).use(router).mount('#app')

// import Alpine from 'alpinejs';
//
// window.Alpine = Alpine;
//
// Alpine.start();

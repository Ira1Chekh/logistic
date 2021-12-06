import { createRouter, createWebHistory } from 'vue-router'

import CompaniesIndex from '../components/companies/CompaniesIndex.vue'
import CompaniesCreate from '../components/companies/CompaniesCreate.vue'
import CompaniesEdit from '../components/companies/CompaniesEdit.vue'
import CargoTypesIndex from '../components/cargoTypes/CargoTypesIndex.vue';
import CargoTypesCreate from "../components/cargoTypes/CargoTypesCreate";
import CargoTypesEdit from "../components/cargoTypes/CargoTypesEdit";
import VehicleTypesIndex from "../components/vehicleTypes/VehicleTypesIndex";
import VehicleTypesCreate from "../components/vehicleTypes/VehicleTypesCreate";
import VehicleTypesEdit from "../components/vehicleTypes/VehicleTypesEdit";

const routes = [
    {
        path: '/dashboard',
        name: 'companies.index',
        component: CompaniesIndex
    },
    {
        path: '/companies',
        name: 'companies.index',
        component: CompaniesIndex
    },
    {
        path: '/companies/create',
        name: 'companies.create',
        component: CompaniesCreate
    },
    {
        path: '/companies/:id/edit',
        name: 'companies.edit',
        component: CompaniesEdit,
        props: true
    },
    {
        path: '/cargo-types',
        name: 'cargo-types.index',
        component: CargoTypesIndex
    },
    {
        path: '/cargo-types/create',
        name: 'cargo-types.create',
        component: CargoTypesCreate
    },
    {
        path: '/cargo-types/:id/edit',
        name: 'cargo-types.edit',
        component: CargoTypesEdit,
        props: true
    },
    {
        path: '/vehicle-types',
        name: 'vehicle-types.index',
        component: VehicleTypesIndex
    },
    {
        path: '/vehicle-types/create',
        name: 'vehicle-types.create',
        component: VehicleTypesCreate
    },
    {
        path: '/vehicle-types/:id/edit',
        name: 'vehicle-types.edit',
        component: VehicleTypesEdit,
        props: true
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
})

import { createRouter, createWebHistory } from 'vue-router'

import CargoTypesIndex from '../components/cargoTypes/CargoTypesIndex.vue';
import CargoTypesCreate from "../components/cargoTypes/CargoTypesCreate";
import CargoTypesEdit from "../components/cargoTypes/CargoTypesEdit";
import VehicleTypesIndex from "../components/vehicleTypes/VehicleTypesIndex";
import VehicleTypesCreate from "../components/vehicleTypes/VehicleTypesCreate";
import VehicleTypesEdit from "../components/vehicleTypes/VehicleTypesEdit";
import UsersIndex from "../components/users/UsersIndex";
import InviteUser from "../components/users/InviteUser";
import OrdersIndex from "../components/orders/OrdersIndex";
import OrdersCreate from "../components/orders/OrdersCreate";

const routes = [
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
    {
        path: '/users',
        name: 'users.index',
        component: UsersIndex,
        props: (route) => ({ query: route.query.role })
    },
    {
        path: '/invite-user',
        name: 'invite-user',
        component: InviteUser,
        props: (route) => ({ query: route.query.role })
    },
    {
        path: '/orders',
        name: 'orders.index',
        component: OrdersIndex
    },
    {
        path: '/orders/create',
        name: 'orders.create',
        component: OrdersCreate
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})

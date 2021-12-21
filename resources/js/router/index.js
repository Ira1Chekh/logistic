import { createRouter, createWebHistory } from 'vue-router'

import CargoTypesIndex from '../components/cargoTypes/CargoTypesIndex.vue';
import CargoTypesCreate from "../components/cargoTypes/CargoTypesCreate";
import CargoTypesEdit from "../components/cargoTypes/CargoTypesEdit";
import VehicleTypesIndex from "../components/vehicleTypes/VehicleTypesIndex";
import VehicleTypesCreate from "../components/vehicleTypes/VehicleTypesCreate";
import VehicleTypesEdit from "../components/vehicleTypes/VehicleTypesEdit";
import OrdersIndex from "../components/orders/OrdersIndex";
import OrdersCreate from "../components/orders/OrdersCreate";
import ManagersIndex from "../components/managers/ManagersIndex";
import InviteManager from "../components/managers/InviteManager";
import OrdersEdit from "../components/orders/OrdersEdit";
import SettingsIndex from "../components/settings/SettingsIndex";
import SettingsEdit from "../components/settings/SettingsEdit";
import DriversIndex from "../components/drivers/DriversIndex";
import InviteDriver from "../components/drivers/InviteDriver";
import ClientsIndex from "../components/clients/ClientsIndex";
import OrderShow from "../components/orders/OrderShow";
import OrderDriverEdit from "../components/orders/OrderDriverEdit";

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
        path: '/managers',
        name: 'managers.index',
        component: ManagersIndex,
    },
    {
        path: '/invite/manager',
        name: 'invite.manager',
        component: InviteManager,
    },
    {
        path: '/drivers',
        name: 'drivers.index',
        component: DriversIndex,
    },
    {
        path: '/invite/driver',
        name: 'invite.driver',
        component: InviteDriver,
    },
    {
        path: '/clients',
        name: 'clients.index',
        component: ClientsIndex,
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
    },
    {
        path: '/orders/:id/edit',
        name: 'orders.edit',
        component: OrdersEdit,
        props: true
    },
    {
        path: '/orders/:id',
        name: 'orders.show',
        component: OrderShow,
        props: true
    },
    {
        path: '/orders/:id/driver',
        name: 'orders.drivers.edit',
        component: OrderDriverEdit,
        props: true
    },
    {
        path: '/settings',
        name: 'settings.index',
        component: SettingsIndex
    },
    {
        path: '/settings/create',
        name: 'settings.create',
        component: SettingsEdit
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
})

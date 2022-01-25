<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>
    <div class="flex place-content-end mb-4">

        <router-link
            v-if="(user.role === 'manager' && (order.status === 'request' || order.status === 'pending'))
                                     || (user.role === 'client' && order.status === 'request')"
                     :to="{ name: 'orders.edit', params: { id: order.id } }"
                     class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Редагувати
        </router-link>

        <router-link v-if="user.role === 'manager' && order.status === 'paid'"
                     :to="{ name: 'orders.drivers.edit', params: { id: order.id } }"
                     class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Вибрати водія
        </router-link>

        <button v-if="user.role === 'manager' && order.status === 'request'"
                @click="pendingOrder(order.id)"
                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Схвалити</button>

        <button v-if="user.role === 'manager' || (user.role === 'client' && order.status === 'request')"
                @click="declinedOrder(order.id)"
                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Скасувати</button>

        <button v-if="user.role === 'driver' && order.status === 'paid'"
                @click="inProgressOrder(order.id)"
                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Взяти в роботу</button>

        <button v-if="user.role === 'driver' && order.status === 'in_progress'"
                @click="doneOrder(order.id)"
                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Виконан</button>

    </div>

    <div class="space-y-6">
        <div class="space-y-4 rounded-md shadow-sm">
            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Назва: {{ order.name }}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Статус: {{ order.status_name }}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Опис: {{ order.description }}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Клієнт: {{ order.client.full_name }}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Водій: {{ order.driver ? order.driver.full_name : '---' }}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Вага грузу: {{ order.cargo_weight }}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Тип грузу: {{ order.cargo_type.name }}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Тип кузова: {{order.vehicle_type.name}}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Дата відправлення: {{ order.start_date_label }}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Дата отримання: {{order.due_date_label}}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Місто відправлення грузу: {{order.city_from.name}}</label>
            </div>

            <div class="mt-2">
                <label class="block text-sm font-medium text-gray-700">Місто доставки грузу: {{order.city_to.name}}</label>
            </div>

        </div>
    </div>
</template>

<script>
import useOrders from '../../composables/orders'
import {onMounted} from 'vue';

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

    setup(props) {
        const { errors, order, getOrder, user, getUser, updateStatus } = useOrders()

        const pendingOrder = async (id) => {
            await updateStatus('pending', id);
            await getOrder(props.id)
        };

        const inProgressOrder = async (id) => {
            await updateStatus('in_progress', id);
            await getOrder(props.id)
        };

        const doneOrder = async (id) => {
            await updateStatus('done', id);
            await getOrder(props.id)
        };

        const declinedOrder = async (id) => {
            if (!window.confirm('Вы уверены?')) {
                return
            }

            await updateStatus('declined', id);
            await getOrder(props.id)
        };

        onMounted(getOrder(props.id))
        onMounted(getUser)

        return {
            errors,
            order,
            user,
            pendingOrder,
            inProgressOrder,
            doneOrder,
            declinedOrder
        }
    }
}
</script>

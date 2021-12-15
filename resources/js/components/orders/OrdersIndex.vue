<template>
    <div class="flex place-content-end mb-4">
        <template v-if="user.role === 'client'">
            <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
                <router-link :to="{ name: 'orders.create' }" class="text-sm font-medium">Создать заказ</router-link>
            </div>
        </template>

    </div>

    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Название</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Тип груза</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Тип кузова</span>
                </th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
            <template v-for="item in orders" :key="item.id">
                <tr class="bg-white">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.name }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.cargo_type }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.vehicle_type }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <router-link :to="{ name: 'orders.edit', params: { id: item.id } }"
                                     class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Редактировать
                        </router-link>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import useOrders from '../../composables/orders'
import { onMounted } from 'vue';

export default {
    setup() {
        const { orders, getOrders, user, getUser } = useOrders()

        onMounted(getOrders)
        onMounted(getUser)

        return {
            orders,
            user
        }
    }
}
</script>

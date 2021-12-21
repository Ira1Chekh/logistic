<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" v-on:submit.prevent="saveOrder">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Назва</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="order.name">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Статус: {{ order.status_name }}</label>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Опис</label>
                <div class="mt-1">
                    <input type="text" name="description" id="description"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="order.description">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Клієнт: {{ order.client.full_name }}</label>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Водій: {{ order.driver ? order.driver.full_name : '---' }}</label>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Вага грузу</label>
                <div class="mt-1">
                    <input type="number" name="cargo_weight" id="cargo_weight"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="order.cargo_weight">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Тип грузу: {{ order.cargo_type.name }}</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='order.cargo_type'>
                            <option :value='order.cargo_type.id'>{{ order.cargo_type.name }}</option>
                            <option v-for='item in cargoTypes' :value='item.id'>{{ item.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Тип кузова: {{order.vehicle_type.name}}</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='order.vehicle_type'>
                            <option :value='order.vehicle_type.id'>{{order.vehicle_type.name}}</option>
                            <option v-for='item in vehicleTypes' :value='item.id'>{{ item.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Дата відправлення</label>
                <div class="mt-1">
                    <input type="date" name="start_date" id="start_date"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="order.start_date">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Дата отримання</label>
                <div class="mt-1">
                    <input type="date" name="due_date" id="due_date"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="order.due_date">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Місто відправлення грузу: {{order.city_from.name}}</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='order.city_from'>
                            <option :value='order.city_from.id'>{{order.city_from.name}}</option>
                            <option v-for='item in cities' :value='item.id'>{{ item.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Місто доставки грузу: {{order.city_to.name}}</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='order.city_to'>
                            <option :value='order.city_to.id'>{{order.city_to.name}}</option>
                            <option v-for='item in cities' :value='item.id'>{{ item.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Зберігти
        </button>
    </form>
</template>

<script>
import useOrders from '../../composables/orders'
import { onBeforeMount } from 'vue';

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

    setup(props) {
        const { errors, order, updateOrder, getOrder, cargoTypes, vehicleTypes, cities, getVehicleTypes, getCargoTypes, getCities } = useOrders()

        onBeforeMount(() => {
            getOrder(props.id)
            getCargoTypes();
            getVehicleTypes();
            getCities();
        })

        const saveOrder = async () => {
            await updateOrder(props.id)
        }

        return {
            errors,
            order,
            saveOrder,
            cargoTypes,
            vehicleTypes,
            cities
        }
    }
}
</script>

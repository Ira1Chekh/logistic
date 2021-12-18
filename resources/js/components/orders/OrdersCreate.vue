<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" @submit.prevent="saveOrder">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Назва</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.name">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Опис</label>
                <div class="mt-1">
                    <input type="text" name="description" id="description"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.description">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Вага грузу</label>
                <div class="mt-1">
                    <input type="number" name="cargo_weight" id="cargo_weight"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.cargo_weight">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Тип груза</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='form.cargo_type'>
                            <option v-for='item in cargoTypes' :value='item.id'>{{ item.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Тип кузова</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='form.vehicle_type'>
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
                           v-model="form.start_date">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Дата отримання</label>
                <div class="mt-1">
                    <input type="date" name="due_date" id="due_date"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.due_date">
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Місто відправлення грузу</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='form.city_from'>
                            <option v-for='item in cities' :value='item.id'>{{ item.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Місто доставки грузу</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='form.city_to'>
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
import {onMounted, reactive} from 'vue'
import useOrders from "../../composables/orders";

export default {
    setup() {
        const form = reactive({
            name: '',
            description: '',
            cargo_weight: 0,
            cargo_type: 0,
            vehicle_type: 0,
            start_date: '',
            due_date: '',
            city_from: 0,
            city_to: 0,
        })

        const { errors, storeOrder, cargoTypes, vehicleTypes, cities, getVehicleTypes, getCargoTypes, getCities } = useOrders()

        onMounted(getCargoTypes)
        onMounted(getVehicleTypes)
        onMounted(getCities)

        const saveOrder = async () => {
            await storeOrder({ ...form })
        }

        return {
            form,
            errors,
            saveOrder,
            cargoTypes,
            vehicleTypes,
            cities
        }
    }
}
</script>

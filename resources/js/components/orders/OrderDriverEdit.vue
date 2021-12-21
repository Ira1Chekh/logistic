<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" v-on:submit.prevent="saveOrder">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label class="block text-sm font-medium text-gray-700">Назва: {{order.name}}</label>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Маршрут: {{order.city_from.name}} - {{order.city_to.name}}</label>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Період: {{order.start_date}} - {{order.due_date}}</label>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Водій: {{ order.driver ? order.driver.full_name : '---' }}</label>
                <div class="mt-1">
                    <div class="form-group">
                        <select class='form-control' v-model='form.driver'>
                            <option v-for='item in drivers' :value='item.id'>{{ item.full_name }}</option>
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
import {onBeforeMount, reactive} from 'vue';

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

    setup(props) {
        const { errors, order, setDriver,  getOrder, drivers, getDrivers } = useOrders()

        onBeforeMount(() => {
            getOrder(props.id)
            getDrivers()
        })

        const form = reactive({
            driver: order.driver ? order.driver.id : 0,
        })

        const saveOrder = async () => {
            await setDriver(props.id, form.driver)
        }

        return {
            errors,
            form,
            order,
            saveOrder,
            drivers
        }
    }
}
</script>

import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useOrders() {
    const order = ref([])
    const orders = ref([])
    const cargoTypes = ref([])
    const vehicleTypes = ref([])
    const cities = ref([])
    const user = ref([])
    const drivers = ref([])

    const errors = ref('')
    const router = useRouter()

    const getOrders = async () => {
        let response = await axios.get('/api/orders')
        orders.value = response.data.data
    }

    const getOrder = async (id) => {
        let response = await axios.get(`/api/orders/${id}`)
        order.value = response.data.data
    }

    const getCargoTypes = async () => {
        let response = await axios.get('/api/cargo-types')
        cargoTypes.value = response.data.data
    }

    const getVehicleTypes = async () => {
        let response = await axios.get('/api/vehicle-types')
        vehicleTypes.value = response.data.data
    }

    const getCities = async () => {
        let response = await axios.get('/api/cities')
        cities.value = response.data.data
    }

    const getUser = async () => {
        let response = await axios.get('/api/user')
        user.value = response.data.data
    }

    const getDrivers = async () => {
        let response = await axios.get('/api/drivers')
        drivers.value = response.data.data
    }

    const storeOrder = async (data) => {
        errors.value = ''
        try {
            console.log(['store', data])
            await axios.post('/api/orders', data)
            await router.push({ name: 'orders.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }

    }

    const updateOrder = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/orders/${id}`, order.value)
            await router.push({ name: 'orders.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updateStatus = async (value, id) => {
        errors.value = ''
        try {
            await axios.put(`/api/orders/${id}/status`, {'status': value})
            await router.push({ name: 'orders.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    };

    const setDriver = async (id, driverId) => {
        errors.value = ''
        try {
            await axios.put(`/api/orders/${id}/driver/${driverId}`)
            await router.push({ name: 'orders.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    };


    return {
        errors,
        order,
        orders,
        cargoTypes,
        vehicleTypes,
        cities,
        user,
        drivers,
        getOrder,
        getOrders,
        getCargoTypes,
        getVehicleTypes,
        getCities,
        getUser,
        getDrivers,
        storeOrder,
        updateOrder,
        updateStatus,
        setDriver
    }
}

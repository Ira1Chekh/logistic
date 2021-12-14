import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useOrders() {
    const order = ref([])
    const orders = ref([])
    const cargoTypes = ref([])

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

    const storeOrder = async (data) => {
        errors.value = ''
        try {
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

    const updateOrderStatus = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/orders/${id}/status`, order.value)
            await router.push({ name: 'orders.status.update' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    return {
        errors,
        order,
        orders,
        cargoTypes,
        getOrder,
        getOrders,
        getCargoTypes,
        storeOrder,
        updateOrder,
        updateOrderStatus
    }
}

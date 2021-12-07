import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useVehicleTypes() {
    const vehicleType = ref([])
    const vehicleTypes = ref([])

    const errors = ref('')
    const router = useRouter()

    const getVehicleTypes = async () => {
        let response = await axios.get('/api/vehicle-types')
        vehicleTypes.value = response.data.data
    }

    const getVehicleType = async (id) => {
        let response = await axios.get(`/api/vehicle-types/${id}`)
        vehicleType.value = response.data.data
    }

    const storeVehicleType = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/vehicle-types', data)
            await router.push({ name: 'vehicle-types.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }

    }

    const updateVehicleType = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/vehicle-types/${id}`, vehicleType.value)
            await router.push({ name: 'vehicle-types.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const destroyVehicleType = async (id) => {
        await axios.delete(`/api/vehicle-types/${id}`)
    }

    return {
        errors,
        vehicleType,
        vehicleTypes,
        getVehicleType,
        getVehicleTypes,
        storeVehicleType,
        updateVehicleType,
        destroyVehicleType
    }
}

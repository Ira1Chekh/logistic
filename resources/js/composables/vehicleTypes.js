import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function usevehicleTypes() {
    const vehicleType = ref([])
    const vehicleTypes = ref([])

    const errors = ref('')
    const router = useRouter()

    const getvehicleTypes = async () => {
        let response = await axios.get('/api/vehicle-types')
        vehicleTypes.value = response.data.data
    }

    const getvehicleType = async (id) => {
        let response = await axios.get(`/api/vehicle-types/${id}`)
        vehicleType.value = response.data.data
    }

    const storevehicleType = async (data) => {
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

    const updatevehicleType = async (id) => {
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

    const destroyvehicleType = async (id) => {
        await axios.delete(`/api/vehicle-types/${id}`)
    }

    return {
        errors,
        vehicleType,
        vehicleTypes,
        getvehicleType,
        getvehicleTypes,
        storevehicleType,
        updatevehicleType,
        destroyvehicleType
    }
}

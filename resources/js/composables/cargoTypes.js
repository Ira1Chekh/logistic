import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useCargoTypes() {
    const cargoType = ref([])
    const cargoTypes = ref([])

    const errors = ref('')
    const router = useRouter()

    const getCargoTypes = async () => {
        let response = await axios.get('/api/cargo-types')
        cargoTypes.value = response.data.data
    }

    const getCargoType = async (id) => {
        let response = await axios.get(`/api/cargo-types/${id}`)
        cargoType.value = response.data.data
    }

    const storeCargoType = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/cargo-types', data)
            await router.push({ name: 'cargo-types.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }

    }

    const updateCargoType = async (id) => {
        errors.value = ''
        try {
            await axios.patch(`/api/cargo-types/${id}`, cargoType.value)
            await router.push({ name: 'cargo-types.index' })
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const destroyCargoType = async (id) => {
        await axios.delete(`/api/cargo-types/${id}`)
    }

    return {
        errors,
        cargoType,
        cargoTypes,
        getCargoType,
        getCargoTypes,
        storeCargoType,
        updateCargoType,
        destroyCargoType
    }
}

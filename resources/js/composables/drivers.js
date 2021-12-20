import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useDrivers() {
    const drivers = ref([])

    const errors = ref('')
    const router = useRouter()

    const getDrivers = async () => {
        let response = await axios.get('/api/drivers')
        drivers.value = response.data.data
    }

    const inviteDriver = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/invite/driver', data)
            await router.push({ name: 'drivers.index' })
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
        drivers,
        getDrivers,
        inviteDriver
    }
}

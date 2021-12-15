import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useManagers() {
    const managers = ref([])

    const errors = ref('')
    const router = useRouter()

    const getManagers = async () => {
        let response = await axios.get('/api/managers')
        managers.value = response.data.data
    }

    const inviteManager = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/invite/manager', data)
            await router.push({ name: 'managers.index' })
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
        managers,
        getManagers,
        inviteManager
    }
}

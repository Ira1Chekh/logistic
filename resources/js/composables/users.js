import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useUsers() {
    const users = ref([])

    const errors = ref('')
    const router = useRouter()

    const allParams = new URLSearchParams(window.location.search)

    const getUsers = async () => {
        let response = await axios.get('/api/users', {params: {role: allParams.get('role')}})
        users.value = response.data.data
    }

    const inviteUser = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/invite-user', data)
            await router.push({ name: 'users.index' })
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
        users,
        getUsers,
        inviteUser
    }
}

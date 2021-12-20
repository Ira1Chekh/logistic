import { ref } from 'vue'
import axios from 'axios'

export default function useClients() {
    const clients = ref([])

    const errors = ref('')

    const getClients = async () => {
        let response = await axios.get('/api/clients')
        clients.value = response.data.data
    }

    return {
        errors,
        clients,
        getClients
    }
}

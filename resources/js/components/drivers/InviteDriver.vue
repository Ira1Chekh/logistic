<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" @submit.prevent="processDriver">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Електронна пошта</label>
                <div class="mt-1">
                    <input type="email" name="email" id="email"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.email">
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center mt-4 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Відправити
        </button>
    </form>
</template>

<script>
import { reactive } from 'vue'
import useDrivers from "../../composables/drivers";
import { useRouter } from 'vue-router'

export default {
    setup() {
        const router = useRouter()
        const form = reactive({
            email: '',
        })

        const { errors, inviteDriver } = useDrivers()

        const processDriver = async () => {
            await inviteDriver({ ...form })
            await router.push({ name: 'drivers.index' })
        }

        return {
            form,
            errors,
            processDriver
        }
    }
}
</script>

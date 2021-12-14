<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" @submit.prevent="processUser">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Электронная почта</label>
                <div class="mt-1">
                    <input type="email" name="email" id="email"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.email">
<!--                    <input type="hidden" name="role" id="role" :value="allParams.get('role')"-->
<!--                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"-->
<!--                          >-->
                </div>
<!--                <div class="mt-1">-->
<!--                    <label for="role" class="block text-sm font-medium text-gray-700">Роль</label>-->
<!--                    <div class="form-group">-->
<!--                        <select class='form-control' v-model='form.cargo_type'>-->
<!--                            <option v-for='item in cargoTypes' :value='item.id'>{{ item.name }}</option>-->
<!--                        </select>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Отправить
        </button>
    </form>
</template>

<script>
import { reactive } from 'vue'
import useUsers from "../../composables/users";

export default {
    setup() {
        const form = reactive({
            email: '',
        })
        const allParams = new URLSearchParams(window.location.search)

        const { errors, inviteUser } = useUsers()

        const processUser = async () => {
            await inviteUser({ ...form, role: allParams.get('role') })
        }

        return {
            form,
            errors,
            processUser,
            allParams
        }
    }
}
</script>

<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" v-on:submit.prevent="saveCargoType">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Назва</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="cargoType.name">
                </div>
            </div>

        </div>

        <button type="submit"
                class="inline-flex items-center mt-4 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Зберегти
        </button>
    </form>
</template>

<script>
import useCargoTypes from '../../composables/cargoTypes'
import { onMounted } from 'vue';

export default {
    props: {
        id: {
            required: true,
            type: String
        }
    },

    setup(props) {
        const { errors, cargoType, updateCargoType, getCargoType } = useCargoTypes()

        onMounted(() => getCargoType(props.id))

        const saveCargoType = async () => {
            await updateCargoType(props.id)
        }

        return {
            errors,
            cargoType,
            saveCargoType
        }
    }
}
</script>

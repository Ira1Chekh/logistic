<template>
    <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form class="space-y-6" v-on:submit.prevent="saveSettings">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="fuel_price" class="block text-sm font-medium text-gray-700">Ціна топліва</label>
                <div class="mt-1">
                    <input type="number" name="fuel_price" id="fuel_price"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="settings.fuel_price">
                </div>
            </div>

            <div>
                <label for="tax_percent" class="block text-sm font-medium text-gray-700">Податки, %</label>
                <div class="mt-1">
                    <input type="number" name="tax_percent" id="tax_percent"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="settings.tax_percent">
                </div>
            </div>

            <div>
                <label for="enterprise_percent" class="block text-sm font-medium text-gray-700">Доля підприємства, %</label>
                <div class="mt-1">
                    <input type="number" name="enterprise_percent" id="enterprise_percent"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="settings.enterprise_percent">
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Зберігти
        </button>
    </form>
</template>

<script>
import useSettings from '../../composables/settings'
import {onMounted} from 'vue';

export default {
    setup() {
        const { errors, settings, storeSettings, getSettings } = useSettings()

        onMounted(getSettings)

        const saveSettings = async () => {
            await storeSettings(settings.value)
        }

        return {
            errors,
            settings,
            saveSettings
        }
    }
}
</script>

<template>
    <div class="flex place-content-end mb-4">
        <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
            <router-link :to="{ name: 'settings.create' }" class="text-sm font-medium">Редагувати</router-link>
        </div>
    </div>

    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Ціна топліва</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Податки, %</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Доля підприємства, %</span>
                </th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">

                <tr class="bg-white">
                    <td class="px-6 py-3 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ settings.fuel_price }}
                    </td>
                    <td class="px-6 py-3 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ settings.tax_percent }}
                    </td>
                    <td class="px-6 py-3 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ settings.enterprise_percent }}
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
import useSettings from '../../composables/settings'
import { onMounted } from 'vue';

export default {
    setup() {
        const { settings, getSettings } = useSettings()

        onMounted(getSettings)

        return {
            settings
        }
    }
}
</script>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    sections: Object
});
</script>

<template>
    <Head title="Sections" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sections</h2>
                <Link class="border py-1 px-3 rounded hover:text-indigo-500 font-medium">
                    New Section
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="align-middle inline-block min-w-full shadow-sm rounded-sm border-b border-gray-200 bg-white">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-y border-gray-200 bg-gray-50">
                                            <th width="5%" scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                            <tr v-for="section in props.sections" :key="section.id" class="border-b border-gray-200">
                                                <td width="5%" class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-900">{{ section.id }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-900">{{ section.name }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap text-center">
                                                    <div class="text-sm leading-5 text-gray-900">Active</div>
                                                </td>

                                                <td width="5%" class="px-6 py-4 whitespace-no-wrap text-sm text-center leading-5 font-medium">
                                                    <Link class="hover:text-indigo-500">
                                                        Edit
                                                    </Link>
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

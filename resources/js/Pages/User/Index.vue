<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SortableTableHeader from '@/Components/SortableTableHeader.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    users: Object
});

const sortingForm = useForm({
    id: null,
    name: null,
    email: null
});

const sort = (column, value) => {
    sortingForm.defaults({
    id: null,
    name: null,
    email: null
})
    sortingForm.reset();
    sortingForm[column] = value;

    sortingForm.get('/users', {
        preserveState: true
    });
}
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-col">
                        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="align-middle inline-block min-w-full shadow-sm rounded-sm border-b border-gray-200 bg-white">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-y border-gray-200 bg-gray-50">
                                            <SortableTableHeader width="5%" :value="sortingForm.id" column-name="id" @change-state="sort">
                                                ID
                                            </SortableTableHeader>
                                            <SortableTableHeader column-name="name" @change-state="sort">
                                                Name
                                            </SortableTableHeader>
                                            <SortableTableHeader column-name="email" @change-state="sort">
                                                Email
                                            </SortableTableHeader>
                                            <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-center">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                            <tr v-for="user in props.users" :key="user.id" class="border-b border-gray-200">
                                                <td width="5%" class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-700">{{ user.id }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-700">{{ user.name }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-700">{{ user.email }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap text-center">
                                                    <div class="text-xs leading-5 text-gray-700 font-medium">
                                                        <span v-if="user.active" class="bg-green-100 px-2 py-1 rounded-lg text-green-500">active</span>
                                                        <span v-else class="bg-red-100 px-2 py-1 rounded-lg text-red-500">inactive</span>
                                                    </div>
                                                </td>

                                                <td width="5%" class="px-6 py-4 whitespace-no-wrap text-sm text-center leading-5 font-medium">
                                                    <Link :href="route('users.edit', user.id)" class="hover:text-indigo-500 text-gray-700">
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
    </AuthenticatedLayout>
</template>

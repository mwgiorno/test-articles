<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null
});
</script>

<template>
    <Head title="New Section" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Section</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-xl p-4 sm:p-8 mx-auto bg-white shadow sm:rounded-lg text-sm">
                    <form @submit.prevent="form.post(route('sections.store'))" class="space-y-6">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <button type="submit" class="border rounded p-2 px-6 bg-indigo-500 text-white hover:bg-indigo-600 font-semibold">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

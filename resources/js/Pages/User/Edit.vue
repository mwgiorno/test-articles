<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
});

const form = useForm({
    name: props.user.name,
    active: props.user.active,
    admin: props.user.admin
});

const submit = () => {
    form.patch(route('users.update', props.user.id));
};
</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 mx-auto bg-white shadow sm:rounded-lg text-sm">
                    <form @submit.prevent="submit" class="space-y-6">
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

                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-bind:model-value="props.user.email"
                                disabled
                            />
                        </div>

                        <div>
                            <label class="flex items-center">
                                <Checkbox name="active" v-model:checked="form.active" />
                                <span class="ml-2 text-sm text-gray-600">Active</span>
                            </label>
                        </div>
                        <div>
                            <label class="flex items-center">
                                <Checkbox name="admin" v-model:checked="form.admin" />
                                <span class="ml-2 text-sm text-gray-600">Give access to admin panel </span>
                            </label>
                        </div>

                        <button type="submit" class="border rounded p-2 px-6 bg-indigo-500 text-white hover:bg-indigo-600 font-semibold">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

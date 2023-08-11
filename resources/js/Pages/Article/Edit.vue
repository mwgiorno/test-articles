<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    article: Object,
    sections: Object,
    selected: Object
});

const form = useForm({
    _method: 'patch',
    thumbnail: null,
    headline: props.article.headline,
    slug: props.article.slug,
    body: props.article.body,
    sections: props.selected,
    published: props.article.published
});

const submit = () => {
    form.post(route('articles.update', props.article.id));
};
</script>

<template>
    <Head title="Edit Article" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Section</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 mx-auto bg-white shadow sm:rounded-lg text-sm">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="thumbnail" value="Thumbnail" />

                            <input
                                id="thumbnail"
                                type="file"
                                class="mt-1 block w-full"
                                @input="form.thumbnail = $event.target.files[0]"
                                autofocus
                                autocomplete="thumbnail"
                            />

                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>

                            <InputError class="mt-2" :message="form.errors.thumbnail" />
                        </div>

                        <div>
                            <InputLabel for="headline" value="Headline" />

                            <TextInput
                                id="headline"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.headline"
                                required
                                autofocus
                                autocomplete="headline"
                            />

                            <InputError class="mt-2" :message="form.errors.headline" />
                        </div>

                        <div>
                            <InputLabel for="slug" value="Slug" />

                            <TextInput
                                id="slug"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.slug"
                                required
                                autofocus
                                autocomplete="slug"
                            />

                            <InputError class="mt-2" :message="form.errors.slug" />
                        </div>

                        <div>
                            <InputLabel for="sections" value="Sections" />

                            <select
                                id="sections"
                                class="mt-1 block w-full"
                                v-model="form.sections"
                                multiple
                            >
                                <option v-for="section in sections" :key="section.id" :value="section.id">
                                    {{ section.name }}
                                </option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.sections" />
                        </div>

                        <div>
                            <InputLabel for="body" value="Body" />

                            <textarea
                                name="body"
                                id="body"
                                cols="30"
                                rows="10"
                                class="mt-1 block w-full"
                                v-model="form.body"
                                required
                                autofocus
                                autocomplete="body"
                            ></textarea>

                            <InputError class="mt-2" :message="form.errors.body" />
                        </div>

                        <div>
                            <label class="flex items-center">
                                <Checkbox name="published" v-model:checked="form.published" />
                                <span class="ml-2 text-sm text-gray-600">Publish</span>
                            </label>
                        </div>

                        <button type="submit" class="border rounded p-2 px-6 bg-indigo-500 text-white hover:bg-indigo-600 font-semibold">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

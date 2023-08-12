<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { DateTime } from "luxon";
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    articles: Object
});
</script>

<template>
    <Head title="Articles" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Articles</h2>
                <Link :href="route('articles.create')" class="border py-1 px-4 rounded hover:text-indigo-500 font-medium">
                    New Article
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto mx-12 sm:px-6 lg:px-8">
                    <div class="flex flex-col">
                        <div class="-my-2 py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div class="align-middle inline-block min-w-full shadow-sm rounded-sm border-b border-gray-200 bg-white">
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="border-y border-gray-200 bg-gray-50">
                                            <th width="5%" scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                ID
                                            </th>
                                            <th width="35%" scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Headline
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Sections
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Created
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Updated
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
                                            <tr v-for="article in props.articles" :key="article.id" class="border-b border-gray-200">
                                                <td width="5%" class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-700">{{ article.id }}</div>
                                                </td>

                                                <td class="px-6 py-4 flex items-center gap-x-2">
                                                    <img :src="article.thumbnail_url" class="shrink-0 object-cover h-10 w-12 rounded">
                                                    <div class="text-sm leading-5 text-gray-700">{{ article.headline }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <ul class="flex flex-wrap items-center gap-2 text-sm leading-5 text-gray-700">
                                                        <li v-for="section in article.sections" :key="section.id" class="bg-indigo-100 text-xs font-medium p-1 px-2 rounded-lg">
                                                            {{ section.name }}
                                                        </li>
                                                    </ul>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-700">{{ DateTime.fromISO(article.created_at).toFormat('dd.LL.y HH:mm') }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap">
                                                    <div class="text-sm leading-5 text-gray-700">{{ DateTime.fromISO(article.updated_at).toFormat('dd.LL.y HH:mm') }}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap text-center">
                                                    <div class="text-xs leading-5 text-gray-700 font-medium">
                                                        <span v-if="article.published" class="bg-green-100 px-2 py-1 rounded-lg text-green-500">published</span>
                                                        <span v-else class="bg-red-100 px-2 py-1 rounded-lg text-red-500">unpublished</span>
                                                    </div>
                                                </td>

                                                <td width="5%" class="px-6 py-4 whitespace-no-wrap text-sm text-center leading-5 font-medium">
                                                    <Link :href="route('articles.edit', article.id)" class="hover:text-indigo-500 text-gray-700">
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

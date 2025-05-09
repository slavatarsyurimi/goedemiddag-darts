<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Players',
        href: '/players',
    },
];

const props = defineProps({
    players: {
        type: Object,
        default: {},
    },
});

function deletePlayer(id) {
    if (!confirm('Are you sure?')) {
        return;
    }

    router.delete(`players/${id}`);
}
</script>

<template>
    <Head title="Players" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl px-6 py-4">
            <div class="">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-base font-semibold text-gray-900">Players</h1>
                        <p class="mt-2 text-sm text-gray-700">Goedemiddag! darters.</p>
                    </div>

                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <a
                            :href="route('players.create')"
                            class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Add player
                        </a>
                    </div>
                </div>

                <div class="mt-8 flow-root">
                    <div v-if="!props.players.data.length" class="rounded-md bg-gray-100 p-4">No users found</div>

                    <div v-else class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>

                                        <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-0">
                                            <span class="sr-only">Delete</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    <tr v-for="player in props.players.data" :key="player.id">
                                        <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-0">
                                            {{ player.full_name }}
                                        </td>

                                        <td class="relative py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0">
                                            <a @click="deletePlayer(player.id)" href="#" class="text-indigo-600 hover:text-indigo-900">
                                                Delete
                                                <span class="sr-only">, {{ player.name }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

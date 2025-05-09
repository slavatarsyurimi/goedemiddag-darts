<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Matches',
        href: '/matches',
    },
    {
        title: 'Add match',
        href: '/matches/create',
    },
];

const player1Id = ref(null);
const player2Id = ref(null);

function addMatch() {
    console.log('adding match');

    router.post(
        route('matches.store'),
        {
            player_1_id: player1Id.value,
            player_2_id: player2Id.value,
        },
        {
            onSuccess: () => {
                console.log('nice');
            },
            onError: (errors) => {
                alert(Object.values(errors).flat().join('\n'));
            },
        },
    );
}

const props = defineProps({
    players: {
        type: Object,
        default: {},
    },
});
</script>

<template>
    <Head title="Add match" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl px-6 py-4">
            <div class="space-y-6">
                <div class="grid gap-2">
                    <Label for="full_name">Player 1</Label>
                    <select
                        id="player-select"
                        v-model="player1Id"
                        class="focus:ring-opacity-50 mt-1 block h-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500"
                    >
                        <option v-for="player in props.players.data" :key="player.id" :value="player.id">
                            {{ player.full_name }}
                        </option>
                    </select>
                </div>

                <div class="grid gap-2">
                    <Label for="full_name">Player 2</Label>
                    <select
                        id="player-select"
                        v-model="player2Id"
                        class="focus:ring-opacity-50 mt-1 block h-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500"
                    >
                        <option v-for="player in props.players.data" :key="player.id" :value="player.id">
                            {{ player.full_name }}
                        </option>
                    </select>
                </div>

                <div class="flex items-center gap-4">
                    <Button @click="addMatch">Save</Button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

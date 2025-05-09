<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Players',
        href: '/players',
    },
    {
        title: 'Add player',
        href: '/players/create',
    },
];

const form = useForm({
    full_name: '',
});

const addPlayer = () => {
    form.post(route('players.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            router.visit(route('players.index'));
        },
    });
};
</script>

<template>
    <Head title="Add player" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl px-6 py-4">
            <form @submit.prevent="addPlayer" class="space-y-6">
                <div class="grid gap-2">
                    <Label for="full_name">Full name</Label>

                    <Input
                        id="full_name"
                        ref="fullNameInput"
                        v-model="form.full_name"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Full name"
                    />
                </div>

                <div class="flex items-center gap-4">
                    <Button :disabled="form.processing">Save</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div v-if="Array.isArray(ToastList) && ToastList.length > 0">
            <ToastList :items="ToastList"/>
        </div>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            testing
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ToastList from '@/Components/ToastList.vue';

defineProps({
    ToastList: {
        type: Array,
        default: () => []
    },
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

</script>

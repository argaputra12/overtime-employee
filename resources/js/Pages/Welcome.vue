<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

</script>

<template>
    <Head title="Welcome" />
    <Navbar :can-login="canLogin" :can-register="canRegister" />
    <div class="container mx-auto p-4">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold">Welcome to ABC Construction</h1>
            <p class="my-4">This application is for authorized personnel only. Please login to access the system.</p>
            <Link :href="route('login')" class="text-blue-500 hover:text-blue-700">Login</Link>
        </div>
    </div>

</template>

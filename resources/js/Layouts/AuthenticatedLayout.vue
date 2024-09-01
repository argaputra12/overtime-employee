<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Sidebar from '@/Components/Sidebar.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    isActive: Boolean,
});

</script>

<template>
    <div>
        <Navbar :can-login="canLogin" :can-register="canRegister" :is-active="isActive" class="z-100"/>
        <slot />
    </div>
</template>


<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';

const showingNavigationDropdown = ref(false);

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    isActive: Boolean,
});


</script>

<template>
    <Navbar :can-login="canLogin" :can-register="canRegister" :is-active="isActive"/>

</template>


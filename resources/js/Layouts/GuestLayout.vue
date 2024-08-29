<script setup>
import { Link } from '@inertiajs/vue3';
import { FwbNavbarLogo } from 'flowbite-vue';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <fwb-navbar-logo alt="Flowbite logo" image-url="https://www.svgrepo.com/show/414688/contractor-builder-15.svg" link="#" class="flex flex-col gap-3">
                ABC Construction
            </fwb-navbar-logo>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

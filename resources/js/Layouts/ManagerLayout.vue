<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Sidebar from "@/Components/Sidebar.vue";
</script>

<template>
    <AuthenticatedLayout>
        <div class="mx-auto flex">
            <Sidebar />
            <div class="p-4 mx-auto w-full mr-20">
                <slot />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style></style>

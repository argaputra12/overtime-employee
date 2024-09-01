<template>
    <fwb-toast
        v-for="(item, index) in items"
        :type="item.type"
        :key="index"
        closable
    >
        {{ item.message }}
    </fwb-toast>
</template>

<script setup>
import { FwbToast } from 'flowbite-vue';

defineProps({
    items: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <ManagerLayout>
        <div class="flex flex-col gap-4">
            <div>
                <h1 class="text-3xl">Managers Data</h1>
            </div>
            <fwb-table hoverable>
                <fwb-table-head>
                    <fwb-table-head-cell>No</fwb-table-head-cell>
                    <fwb-table-head-cell>Name</fwb-table-head-cell>
                    <fwb-table-head-cell>Phone</fwb-table-head-cell>
                    <fwb-table-head-cell>Address</fwb-table-head-cell>
                    <fwb-table-head-cell>Department</fwb-table-head-cell>
                    <fwb-table-head-cell>
                        <span class="sr-only">Edit</span>
                    </fwb-table-head-cell>
                </fwb-table-head>
                <fwb-table-body>
                    <fwb-table-row v-for="manager in managers.data" :key="manager.id">
                        <fwb-table-cell>{{ managers.data.indexOf(manager) + 1 }}</fwb-table-cell>
                        <fwb-table-cell>{{ manager.name }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            manager.phone_number
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{ manager.address }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            manager.department_name
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{ manager.position }}</fwb-table-cell>
                    </fwb-table-row>
                </fwb-table-body>
            </fwb-table>
            <div class="flex items-center gap-2 mt-4">
                <Pagination :links="managers.links" />
            </div>
        </div>
    </ManagerLayout>
</template>
<script setup>
import ManagerLayout from "@/Layouts/ManagerLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import {
    FwbA,
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
} from "flowbite-vue";

defineProps({
    managers: Object
});

</script>

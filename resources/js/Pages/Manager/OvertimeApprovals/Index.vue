<template>
    <ManagerLayout>
        <div class="flex flex-col gap-4">
            <div>
                <h1 class="text-3xl">Overtime approvals Data</h1>
            </div>
            <div class="flex items-center">
                There are {{ overtime_approvals.data.length }} overtime
                approvals
            </div>
            <fwb-table hoverable>
                <fwb-table-head>
                    <fwb-table-head-cell>No</fwb-table-head-cell>
                    <fwb-table-head-cell>Name</fwb-table-head-cell>
                    <fwb-table-head-cell>Date</fwb-table-head-cell>
                    <fwb-table-head-cell>Start</fwb-table-head-cell>
                    <fwb-table-head-cell>End</fwb-table-head-cell>
                    <fwb-table-head-cell>Duration (hours)</fwb-table-head-cell>
                    <fwb-table-head-cell>Reason</fwb-table-head-cell>
                    <fwb-table-head-cell>Status</fwb-table-head-cell>
                    <fwb-table-head-cell>
                        <span class="sr-only">Edit</span>
                    </fwb-table-head-cell>
                </fwb-table-head>
                <fwb-table-body>
                    <fwb-table-row
                        v-for="overtime_approval in overtime_approvals.data"
                        :key="overtime_approval.id"
                        :class="tableRowClass(overtime_approval)"
                    >
                        <fwb-table-cell>{{
                            overtime_approvals.data.indexOf(overtime_approval) +
                            1
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_approval.employee_name
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_approval.date
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_approval.start_time
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_approval.end_time
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_approval.duration
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_approval.reason
                        }}</fwb-table-cell>
                        <fwb-table-cell class="capitalize">{{
                            overtime_approval.status
                        }}</fwb-table-cell>
                        <fwb-table-cell>
                            <fwb-a href="#"> Edit </fwb-a>
                        </fwb-table-cell>
                    </fwb-table-row>
                </fwb-table-body>
            </fwb-table>
            <div class="flex items-center gap-2 mt-4">
                <Pagination :links="overtime_approvals.links" />
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

const tableRowClass = (overtime_approval) => {
    switch (overtime_approval.status) {
        case "pending":
            return "transition-all duration-150 hover:bg-yellow-50 dark:bg-yellow-900";
        case "approved":
            return "transition-all duration-150 hover:bg-green-50 dark:bg-green-900";
        case "rejected":
            return "transition-all duration-150 hover:bg-red-50 dark:bg-red-900";
        default:
            return "";
    }
};

defineProps({
    overtime_approvals: Object,
});
</script>

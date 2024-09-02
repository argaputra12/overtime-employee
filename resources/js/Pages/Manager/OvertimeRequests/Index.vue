<template>
    <ManagerLayout>
        <div class="flex flex-col gap-4">
            <div>
                <h1 class="text-3xl">Overtime Requests Data</h1>
            </div>
            <div class="flex items-center">
                There are {{ overtime_requests.data.length }} overtime requests
                from your department
            </div>
            <fwb-table hoverable>
                <fwb-table-head>
                    <fwb-table-head-cell>No</fwb-table-head-cell>
                    <fwb-table-head-cell>Name</fwb-table-head-cell>
                    <fwb-table-head-cell>Department</fwb-table-head-cell>
                    <fwb-table-head-cell>Date</fwb-table-head-cell>
                    <fwb-table-head-cell>Start</fwb-table-head-cell>
                    <fwb-table-head-cell>End</fwb-table-head-cell>
                    <fwb-table-head-cell>Duration (hours)</fwb-table-head-cell>
                    <fwb-table-head-cell>Reason</fwb-table-head-cell>
                    <fwb-table-head-cell>
                        <span class="sr-only">Edit</span>
                    </fwb-table-head-cell>
                </fwb-table-head>
                <fwb-table-body>
                    <fwb-table-row
                        v-for="overtime_request in overtime_requests.data"
                        :key="overtime_request.id"
                    >
                        <fwb-table-cell>{{
                            overtime_requests.data.indexOf(overtime_request) + 1
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_request.employee_name
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_request.department_name
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_request.date
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_request.start_time
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_request.end_time
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_request.duration
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            overtime_request.reason
                        }}</fwb-table-cell>
                        <fwb-table-cell>
                            <div class="flex justify-center items-center gap-4">
                                <fwb-a
                                    href="#"
                                    @click="
                                        approveOvertimeRequest(
                                            overtime_request.id
                                        )
                                    "
                                    class="hover:text-green-400 transition-all duration-200"
                                    aria-label="Approve"
                                >
                                    Approve
                                </fwb-a>
                                <fwb-a
                                    href="#"
                                    @click="
                                        pendingOvertimeRequest(
                                            overtime_request.id
                                        )
                                    "
                                    class="hover:text-yellow-400 transition-all duration-200"
                                    aria-label="Pending"
                                >
                                    Pending
                                </fwb-a>
                                <fwb-a
                                    href="#"
                                    @click="
                                        rejectOvertimeRequest(
                                            overtime_request.id
                                        )
                                    "
                                    class="hover:text-red-400 transition-all duration-200"
                                >
                                    Reject
                                </fwb-a>
                            </div>
                        </fwb-table-cell>
                    </fwb-table-row>
                </fwb-table-body>
            </fwb-table>
            <div class="flex items-center gap-2 mt-4">
                <Pagination :links="overtime_requests.links" />
            </div>
        </div>
    </ManagerLayout>
</template>
<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import ManagerLayout from "@/Layouts/ManagerLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
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
    overtime_requests: Object,
});

const user = usePage().props.auth.user;
const form = useForm({
    user_id: user.id,
})

const $toast = useToast();

async function approveOvertimeRequest(id) {
    try {
        const response = await axios.put(
            "/api/overtime_requests/" + id + "/approve", form
        );

        $toast.success(response.data.success, {
            position: "top-right",
        });
    } catch (error) {
        $toast.error(error.response.data.error, {
            position: "top-right",
        });
    }
}

async function pendingOvertimeRequest(id) {
    try {
        const response = await axios.put(
            "/api/overtime_requests/" + id + "/pending", form
        );

        $toast.success(response.data.success, {
            position: "top-right",
        });
    } catch (error) {
        $toast.error(error.response.data.error, {
            position: "top-right",
        });
    }
}
async function rejectOvertimeRequest(id) {
    try {
        const response = await axios.put(
            "/api/overtime_requests/" + id + "/reject", form
        );

        $toast.success(response.data.success, {
            position: "top-right",
        });
    } catch (error) {
        $toast.error(error.response.data.error, {
            position: "top-right",
        });
    }
}
</script>

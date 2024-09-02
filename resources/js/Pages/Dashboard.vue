<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="p-12">
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <div class="rounded-xl p-4 flex flex-col gap-4 items-center">
                    <h1 class="font-semibold">Permintaan Lembur Anda</h1>
                    <fwb-table>
                        <fwb-table-head>
                            <fwb-table-head-cell>ID</fwb-table-head-cell>
                            <fwb-table-head-cell>Date</fwb-table-head-cell>
                            <fwb-table-head-cell>Start</fwb-table-head-cell>
                            <fwb-table-head-cell>End</fwb-table-head-cell>
                            <fwb-table-head-cell>Duration</fwb-table-head-cell>
                            <fwb-table-head-cell>Reason</fwb-table-head-cell>
                            <fwb-table-head-cell></fwb-table-head-cell>
                        </fwb-table-head>
                        <fwb-table-body>
                            <fwb-table-row
                                v-for="overtime_request in overtime_requests.data"
                                :key="overtime_requests.id"
                            >
                                <fwb-table-cell>{{
                                    overtime_request.id
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
                                    <button
                                        class="hover:cursor-pointer"
                                        @click="
                                            deleteOvertimeRequest(
                                                overtime_request.id
                                            )
                                        "
                                    >
                                        <font-awesome-icon icon="trash" />
                                    </button>
                                </fwb-table-cell>
                            </fwb-table-row>
                        </fwb-table-body>
                    </fwb-table>
                    <div class="flex items-center gap-2 mt-4">
                        <Pagination :links="overtime_requests.links" />
                    </div>
                </div>
                <div class="rounded-xl p-4 flex flex-col gap-4 items-center">
                    <h1 class="font-semibold">Persetujuan Lembur Anda</h1>
                    <fwb-table>
                        <fwb-table-head>
                            <fwb-table-head-cell>No</fwb-table-head-cell>
                            <fwb-table-head-cell
                                >Overtime Req ID</fwb-table-head-cell
                            >
                            <fwb-table-head-cell
                                >Manager Name</fwb-table-head-cell
                            >
                            <fwb-table-head-cell>Status</fwb-table-head-cell>
                            <fwb-table-head-cell
                                >Approved at</fwb-table-head-cell
                            >
                            <fwb-table-head-cell></fwb-table-head-cell>
                        </fwb-table-head>
                        <fwb-table-body>
                            <fwb-table-row
                                v-for="overtime_approval in overtime_approvals.data"
                                :key="overtime_approvals.id"
                            >
                                <fwb-table-cell>{{
                                    overtime_approvals.data.indexOf(
                                        overtime_approval
                                    ) + 1
                                }}</fwb-table-cell>
                                <fwb-table-cell>{{
                                    overtime_approval.overtime_request_id
                                }}</fwb-table-cell>
                                <fwb-table-cell>{{
                                    overtime_approval.manager_name
                                }}</fwb-table-cell>
                                <fwb-table-cell class="capitalize">{{
                                    overtime_approval.status
                                }}</fwb-table-cell>
                                <fwb-table-cell>{{
                                    overtime_approval.approved_at
                                }}</fwb-table-cell>
                                <fwb-table-cell>
                                    <div class="flex gap-2">
                                        <form
                                            :action="
                                                route(
                                                    'overtime_approval.show',
                                                    overtime_approval.id
                                                )
                                            "
                                            method="get"
                                        >
                                            <button
                                                class="hover:cursor-pointer"
                                                type="submit"
                                            >
                                                <font-awesome-icon
                                                    icon="file"
                                                />
                                            </button>
                                        </form>
                                        <button
                                            class="hover:cursor-pointer"
                                            @click="
                                                deleteOvertimeApproval(
                                                    overtime_approval.id
                                                )
                                            "
                                        >
                                            <font-awesome-icon icon="trash" />
                                        </button>
                                    </div>
                                </fwb-table-cell>
                            </fwb-table-row>
                        </fwb-table-body>
                    </fwb-table>
                    <div class="flex items-center gap-2 mt-4">
                        <Pagination :links="overtime_approvals.links" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <fwb-button
                    class="mr-4 bg-primary-dark hover:bg-highlight transition-all duration-200"
                    @click="showModal"
                >
                    Ajukan Lembur
                </fwb-button>
            </div>
        </div>

        <!-- Modal -->
        <form @submit.prevent="submitForm">
            <fwb-modal v-if="isShowModal" @close="closeModal">
                <template #header>
                    <div class="flex items-center text-lg">
                        Form Pengajuan Lembur
                    </div>
                </template>
                <template #body>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <fwb-input
                                id="date"
                                type="date"
                                label="Tanggal"
                                v-model="form.date"
                                required
                                autofocus
                            />
                        </div>
                        <div>
                            <fwb-input
                                id="start_time"
                                type="time"
                                label="Jam Mulai"
                                v-model="form.start_time"
                                required
                            />
                        </div>
                        <div>
                            <fwb-input
                                id="end_time"
                                type="time"
                                label="Jam Selesai"
                                v-model="form.end_time"
                                required
                            />
                        </div>
                        <div>
                            <fwb-input
                                id="duration"
                                type="number"
                                label="Durasi"
                                v-model="form.duration"
                                required
                            />
                        </div>
                        <div>
                            <fwb-input
                                id="reason"
                                type="textarea"
                                label="Alasan"
                                v-model="form.reason"
                                required
                            />
                        </div>
                    </div>
                </template>
                <template #footer>
                    <div class="flex justify-between">
                        <fwb-button @click="closeModal" color="alternative">
                            Close
                        </fwb-button>

                        <div class="flex justify-end gap-3">
                            <fwb-a :href="route('profile.edit')" class="hover:cursor-pointer font-light text-sm text-blue-600">
                                Upload tanda tangan
                            </fwb-a>
                            <fwb-button type="submit" color="green">
                                Submit
                            </fwb-button>
                        </div>
                    </div>
                </template>
            </fwb-modal>
        </form>
        <!-- End of Modal -->
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, Link, useForm } from "@inertiajs/vue3";
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
    FwbButton,
    FwbModal,
    FwbInput,
} from "flowbite-vue";
import { defineProps, ref } from "vue";
import Pagination from "@/Components/Pagination.vue";

const user = usePage().props.auth.user;
const error = usePage().props.errors.error;

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    overtime_requests: Object,
    overtime_approvals: Object,
});

const $toast = useToast();
const isShowModal = ref(false);
const form = ref({
    user_id: user.id,
    date: "",
    start_time: "",
    end_time: "",
    duration: "",
    reason: "",
});

function closeModal() {
    isShowModal.value = false;
    form.value = {
        user_id: "",
        date: "",
        start_time: "",
        end_time: "",
        duration: "",
        reason: "",
    };
}
function showModal() {
    isShowModal.value = true;
}

if (error) {
    $toast.error(error, {
        position: "top-right",
    });
}

async function submitForm() {
    try {
        const response = await axios.post(
            "/api/overtime_requests/store",
            form.value
        );

        $toast.success(response.data.success, {
            position: "top-right",
        });
        location.reload();
    } catch (error) {
        $toast.error(error.response.data.error, {
            position: "top-right",
        });
    }
}

const deleteOvertimeRequest = (id) => {
    try {
        axios
            .delete("/api/overtime_requests/destroy/" + id)
            .then((response) => {
                $toast.success(response.data.success, {
                    position: "top-right",
                });
                location.reload();
            });
    } catch (error) {
        $toast.error(error.response.data.message, {
            position: "top-right",
        });
        location.reload();
    }
};

const deleteOvertimeApproval = (id) => {
    try {
        axios
            .delete("/api/overtime_approvals/destroy/" + id)
            .then((response) => {
                $toast.success(response.data.success, {
                    position: "top-right",
                });
                location.reload();
            });
    } catch (error) {
        $toast.error(error.response.data.message, {
            position: "top-right",
        });
        location.reload();
    }
};
</script>

<template>
    <ManagerLayout>
        <div class="flex flex-col gap-4">
            <div class="flex justify-between">
                <h1 class="text-3xl">Employees Data</h1>
                <fwb-button
                    @click="showModal"
                    class="bg-primary-dark hover:bg-highlight hover:text-black duration-200"
                >
                    Create
                </fwb-button>
            </div>
            <fwb-table hoverable>
                <fwb-table-head>
                    <fwb-table-head-cell>No</fwb-table-head-cell>
                    <fwb-table-head-cell>Name</fwb-table-head-cell>
                    <fwb-table-head-cell>Phone</fwb-table-head-cell>
                    <fwb-table-head-cell>Address</fwb-table-head-cell>
                    <fwb-table-head-cell>Department</fwb-table-head-cell>
                    <fwb-table-head-cell>Position</fwb-table-head-cell>
                    <fwb-table-head-cell>
                        <span class="sr-only">Edit</span>
                    </fwb-table-head-cell>
                </fwb-table-head>
                <fwb-table-body>
                    <fwb-table-row
                        v-for="employee in employees.data"
                        :key="employee.id"
                    >
                        <fwb-table-cell>{{
                            employees.data.indexOf(employee) + 1
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{ employee.name }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            employee.phone_number
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{ employee.address }}</fwb-table-cell>
                        <fwb-table-cell>{{
                            employee.department_name
                        }}</fwb-table-cell>
                        <fwb-table-cell>{{ employee.position }}</fwb-table-cell>
                        <fwb-table-cell>
                            <button
                                class="hover:cursor-pointer"
                                @click="deleteEmployee(employee.id)"
                            >
                                <font-awesome-icon icon="trash" />
                            </button>
                        </fwb-table-cell>
                    </fwb-table-row>
                </fwb-table-body>
            </fwb-table>
            <div class="flex items-center gap-2 mt-4">
                <Pagination :links="employees.links" />
            </div>
        </div>

        <!-- Modal -->
        <form @submit.prevent="submitForm">
            <fwb-modal v-if="isShowModal" @close="closeModal">
                <template #header>
                    <div class="flex items-center text-lg">
                        Create New Employee Data
                    </div>
                </template>
                <template #body>
                    <div class="grid grid-cols-2 gap-4">
                        <fwb-input
                            v-model="form.name"
                            type="text"
                            label="Name"
                            placeholder="Name"
                            required
                        />
                        <fwb-input
                            v-model="form.email"
                            type="email"
                            label="Email"
                            placeholder="Email"
                            required
                        />
                        <fwb-input
                            v-model="form.password"
                            type="password"
                            label="Password"
                            placeholder="Password"
                            required
                        />
                        <fwb-input
                            v-model="form.phone_number"
                            type="text"
                            label="Phone Number"
                            placeholder="Phone Number"
                            required
                        />
                        <fwb-input
                            v-model="form.address"
                            type="text"
                            label="Address"
                            placeholder="Address"
                            required
                        />
                        <fwb-select
                            v-model="form.department_id"
                            label="Department"
                            :options="departments"
                            placeholder="Select Department"
                            required
                        >
                        </fwb-select>
                        <fwb-input
                            v-model="form.position"
                            type="text"
                            label="Position"
                            placeholder="Position"
                            required
                        />
                    </div>
                </template>
                <template #footer>
                    <div class="flex justify-between">
                        <fwb-button @click="closeModal" color="alternative">
                            Close
                        </fwb-button>
                        <fwb-button type="submit" color="green">
                            Create
                        </fwb-button>
                    </div>
                </template>
            </fwb-modal>
        </form>
        <!-- End of Modal -->
    </ManagerLayout>
</template>
<script setup>
import ManagerLayout from "@/Layouts/ManagerLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { ref, onMounted } from "vue";
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
    FwbSelect,
} from "flowbite-vue";

defineProps({
    employees: Object,
});

const $toast = useToast();
const isShowModal = ref(false);
const form = ref({
    name: "",
    email: "",
    password: "",
    phone_number: "",
    address: "",
    department_id: "",
    position: "",
});
const departments = ref([]);

onMounted(async () => {
    const response = await axios.get("/api/departments");
    departments.value = response.data;
});

function closeModal() {
    isShowModal.value = false;
}
function showModal() {
    isShowModal.value = true;
}
async function submitForm() {
    try {
        const response = await axios.post(
            "/manager/employees/store",
            form.value
        );
        closeModal();
        $toast.success(response.data.success, {
            position: "top-right",
        });
        location.reload();
    } catch (error) {
        $toast.error(error.response.data.message, {
            position: "top-right",
        });
        location.reload();
    }
}

async function deleteEmployee(id) {
    try {
        const response = await axios.delete("/manager/employees/destroy/" + id);
        $toast.success(response.data.success, {
            position: "top-right",
        });
        location.reload();
    } catch (error) {
        $toast.error(error.response.data.message, {
            position: "top-right",
        });
        location.reload();
    }
}
</script>


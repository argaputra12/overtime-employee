<template>
    <ManagerLayout>
        <div>
            <div class="flex justify-between">
                <h1 class="text-3xl">Your Profile</h1>
            </div>
        </div>

        <div class="p-4">
            <form @submit.prevent="submitForm" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-2 gap-6">
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
                            label="Manager of Department"
                            :options="departments"
                            placeholder="Manager Department"
                            required
                            disabled
                        >
                        </fwb-select>
                        <fwb-file-input
                            @input="form.signature = $event.target.files[0]"
                            label="Signature"
                            accept="image/jpg, image/png, image/jpeg"
                        >
                            <p
                                class="!mt-1 text-sm text-gray-500 dark:text-gray-300"
                            >
                                SVG, PNG, JPG or GIF (MAX. 800x400px).
                            </p>
                        </fwb-file-input>

                        <div
                            v-if="user.signature"
                            class="mb-3 flex flex-col gap-3 p-4 border-2 border-black justify-center items-center w-1/3"
                        >
                            <fwb-img
                                :alt="user.signature"
                                :src="image_url"
                                class="w-32 h-32"
                            />
                            <p>Tanda tangan anda</p>
                        </div>
                    </div>
                </div>
                <fwb-button
                    :disabled="form.processing"
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    Save
                </fwb-button>
            </form>

        </div>
    </ManagerLayout>
</template>

<script setup>
import { onMounted, ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import ManagerLayout from "@/Layouts/ManagerLayout.vue";
import { FwbInput, FwbButton, FwbSelect, FwbFileInput, FwbImg } from "flowbite-vue";
import axios from "axios";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const $toast = useToast();

// Define and destructure props
const props = defineProps({
    manager: Object,
    user: Object,
});

const image_url = computed(() => {
    return window.appConfig.baseUrl + props.user.signature;
});

const form = useForm({
    user_id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    phone_number: props.user.phone_number,
    address: props.user.address,
    department_id: props.manager.department_id,
    signature: props.user.signature,
});

async function submitForm() {
    const formData = new FormData();

    formData.append("user_id", form.user_id);
    formData.append("name", form.name);
    formData.append("email", form.email);
    formData.append("phone_number", form.phone_number);
    formData.append("address", form.address);
    formData.append("signature", form.signature);

    if (form.signature) {
        formData.append("signature", form.signature);
    }

    try {
        const response = await axios.post("/api/manager/signature", formData, {
            "Content-Type": "multipart/form-data",
        });

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

const departments = ref([]);

onMounted(async () => {
    const response = await axios.get("/api/departments");

    departments.value = response.data;
});
</script>

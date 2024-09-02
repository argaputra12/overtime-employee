<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { FwbInput, FwbFileInput, FwbButton, FwbImg } from "flowbite-vue";
import axios from "axios";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const $toast = useToast();

const user = usePage().props.auth.user;

const props = defineProps({
    employee: Object,
});

const form = useForm({
    name: user.name,
    email: user.email,
    phone_number: user.phone_number,
    address: user.address,
    signature: user.signature, // Initialize as null for the file
    position: props.employee.position,
});

async function submitForm() {
    // Create a new FormData object
    const formData = new FormData();

    // Append each form field to the FormData object
    formData.append("name", form.name);
    formData.append("email", form.email);
    formData.append("phone_number", form.phone_number);
    formData.append("address", form.address);
    formData.append("position", form.position);

    // Append the file only if it exists
    if (form.signature) {
        formData.append("signature", form.signature);
    }

    try {
        // Send the FormData using Axios
        const response = await axios.post("/profile", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        // Handle success response
        $toast.success(response.data.success, {
            position: "top-right",
        });

        location.reload();
    } catch (error) {
        // Handle error response
        $toast.error(error.response.data.message, {
            position: "top-right",
        });
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Profile Information
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form
            @submit.prevent="submitForm"
            class="mt-6 space-y-6"
            enctype="multipart/form-data"
        >
            <fwb-input
                v-model="form.name"
                type="text"
                label="Name"
                name="name"
                placeholder="Enter Name"
                autocomplete="name"
            />
            <fwb-input
                v-model="form.phone_number"
                type="text"
                label="Phone Number"
                name="phone_number"
                placeholder="Phone Number"
                autocomplete="phone_number"
            />
            <fwb-input
                v-model="form.address"
                type="text"
                label="Address"
                name="address"
                placeholder="Address"
                autocomplete="address"
            />
            <fwb-input
                v-model="form.position"
                type="text"
                label="Position"
                name="position"
                placeholder="Position"
                autocomplete="position"
            />
            <fwb-input
                v-model="form.email"
                type="email"
                label="Email"
                name="email"
                placeholder="Email"
                autocomplete="email"
            />
            <fwb-file-input
                @input="form.signature = $event.target.files[0]"
                type="file"
                label="Signature"
                name="signature"
                placeholder="Signature"
                accept="image/jpg, image/png, image/jpeg"
            >
                <p class="!mt-1 text-sm text-gray-500 dark:text-gray-300">
                    SVG, PNG, JPG or GIF (MAX. 800x400px).
                </p>
            </fwb-file-input>

            <div
                v-if="user.signature"
                class="flex flex-col gap-3 p-4 border-2 border-black justify-center items-center w-1/3"
            >
                <fwb-img
                    :alt="user.signature"
                    :src="user.signature"
                    class="w-32 h-32"
                />
                <p>Tanda tangan anda</p>
            </div>

            <fwb-button
                :disabled="form.processing"
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                Save
            </fwb-button>
        </form>
    </section>
</template>

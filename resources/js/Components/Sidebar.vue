<template>
    <aside class="flex flex-col w-64 bg-white p-4 mt-2 gap-3">
        <Link
            href="/manager/dashboard"
            class="hover:bg-primary h-10 flex items-center text-xl gap-4 pl-4 rounded-lg w-full"
        >
            <font-awesome-icon class="w-5 h-5" icon="house" />
            <div>Dashboard</div>
        </Link>
        <Link
            href="/manager/managers"
            class="hover:bg-primary h-10 flex items-center text-xl gap-4 pl-4 rounded-lg w-full"
        >
            <font-awesome-icon class="w-5 h-5" icon="user-tie" />
            <div>Manager</div>
        </Link>
        <Link
            href="/manager/employees"
            class="hover:bg-primary h-10 flex items-center text-xl gap-4 pl-4 rounded-lg w-full"
        >
            <font-awesome-icon class="w-5 h-5" icon="users" />
            <div>Employee</div>
        </Link>
        <fwb-sidebar-dropdown-item class="pl-2">
            <template #icon>
                <font-awesome-icon class="w-5 h-5" icon="clock" />
            </template>
            <template #trigger>
                <div class="pl-1 text-xl">Overtime</div>
            </template>
            <template #default>
                <div class="flex flex-col gap-2">
                    <Link
                        href="/manager/overtime_requests/"
                        class="hover:bg-primary h-10 flex items-center text-xl gap-4 pl-11 rounded-lg w-full"
                    >
                        <div>Request</div>
                    </Link>

                    <Link
                        href="/manager/overtime_approvals/"
                        class="hover:bg-primary h-10 flex items-center text-xl gap-4 pl-11 rounded-lg w-full"
                    >
                        <div>Approval</div>
                    </Link>
                </div>

            </template>
        </fwb-sidebar-dropdown-item>
    </aside>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { FwbSidebarDropdownItem, FwbSidebarItem, FwbDropdown } from "flowbite-vue";
</script>

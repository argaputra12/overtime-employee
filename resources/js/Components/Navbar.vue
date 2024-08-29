<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { FwbNavbar, FwbNavbarLink, FwbNavbarCollapse, FwbNavbarLogo, FwbA } from 'flowbite-vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    isActive: {
        type: Boolean,
    },
})

const isShowMenu = ref(false);

const toggleMenu = () => {
    isShowMenu.value = !isShowMenu.value;
}

const closeMenu = () => {
    isShowMenu.value = false;
}

const closeOnEscape = (e) => {
    if (isShowMenu.value && e.key === 'Escape') {
        isShowMenu.value = false;
    }
}

onMounted(() => {
    document.addEventListener('keydown', closeOnEscape);
});

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
});

</script>

<template>
    <fwb-navbar class="shadow-md bg-[#f6f2f0]">
        <template #logo>
            <fwb-navbar-logo alt="Flowbite logo" image-url="https://www.svgrepo.com/show/414688/contractor-builder-15.svg" link="#">
                ABC Construction
            </fwb-navbar-logo>
        </template>
        <template v-if="canLogin || canRegister" #default="{isShowMenu}">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-navbar-link v-if="canLogin" :link="route('login')" :is-active="route().current('login')">
                Login
                </fwb-navbar-link>

                <fwb-navbar-link v-if="canRegister" :link="route('register')" :is-active="route().current('register')">
                Register
                </fwb-navbar-link>
            </fwb-navbar-collapse>
        </template>
        <template v-else #default="{isShowMenu}">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-a :link="route('dashboard')" :is-active="route().current('dashboard')" class="text-[#968172] hover:no-underline">
                Dashboard
                </fwb-a>
                <fwb-a :link="route('logout')" class="hover:text-active-link hover:no-underline transition-all duraion-200">
                Log Out
                </fwb-a>
            </fwb-navbar-collapse>
        </template>
    </fwb-navbar>
</template>

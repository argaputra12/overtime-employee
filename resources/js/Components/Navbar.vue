<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { FwbNavbar, FwbNavbarLink, FwbNavbarCollapse, FwbNavbarLogo, FwbA, FwbDropdown, FwbListGroup, FwbListGroupItem } from 'flowbite-vue';
import { router, usePage } from '@inertiajs/vue3';

const page = usePage();

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

const logout = () => {
    router.post(route('logout'), {
        preserveScroll: true,
        _token: page.props.csrf_token
    });
}

</script>

<template>
    <fwb-navbar class="shadow-md bg-primary">
        <template #logo>
            <fwb-navbar-logo alt="Flowbite logo"
                image-url="https://www.svgrepo.com/show/414688/contractor-builder-15.svg" link="#">
                ABC Construction
            </fwb-navbar-logo>
        </template>
        <template v-if="canLogin || canRegister" #default="{ isShowMenu }">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-navbar-link v-if="canLogin" :link="route('login')" :is-active="route().current('login')">
                    Login
                </fwb-navbar-link>
                <fwb-navbar-link v-if="canRegister" :link="route('register')" :is-active="route().current('register')">
                    Register
                </fwb-navbar-link>
            </fwb-navbar-collapse>
        </template>
        <template #default="{ isShowMenu }" class="flex w-full justify-between items-center">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-dropdown transition="fade"
                    class="hover:text-active-link hover:no-underline transition-all duraion-200 cursor-pointer">
                    <template #trigger :is-active="route().current('profile.show')"
                        class="hover:text-active-link hover:no-underline transition-all duraion-200">
                        <span
                            class="hover:text-active-link hover:no-underline transition-all duraion-200">Profile</span>
                    </template>
                    <fwb-list-group>
                        <fwb-list-group-item :link="{ name: 'profile.show' }"
                            :is-active="route().current('profile.show')"
                            class="hover:bg-highlight transition-all duration-300">
                            Profile
                        </fwb-list-group-item>
                    </fwb-list-group>
                </fwb-dropdown>
                <button @click="logout" type="button"
                    class="hover:no-underline hover:text-active-link transition-all duration-300">
                    Log Out
                </button>
            </fwb-navbar-collapse>
        </template>
    </fwb-navbar>
</template>

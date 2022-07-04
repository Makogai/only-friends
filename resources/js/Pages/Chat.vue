<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';


defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">
        <iframe src="/chatify" class="w-full h-screen"></iframe>
    </AppLayout>
</template>

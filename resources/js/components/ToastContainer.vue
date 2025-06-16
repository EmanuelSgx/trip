<template>
    <div class="fixed right-4 top-4 z-50 space-y-2">
        <Toast
            v-for="toast in toasts"
            :key="toast.id"
            :show="true"
            :type="toast.type"
            :title="toast.title"
            :message="toast.message"
            :auto-close="toast.autoClose !== false"
            :actions="toast.actions"
            @close="removeToast(toast.id)"
        />
    </div>
</template>

<script setup lang="ts">
import { useToast } from '@/composables/useToast';
import Toast from './Toast.vue';

const { toasts, removeToast } = useToast();
</script>

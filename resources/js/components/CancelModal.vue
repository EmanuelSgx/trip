<template>
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
            <div
                class="fixed inset-0 bg-gradient-to-br from-red-900/20 to-pink-900/20 backdrop-blur-sm transition-opacity"
                aria-hidden="true"
                @click="$emit('close')"
            ></div>

            <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block transform overflow-hidden rounded-3xl border border-white/20 bg-white/95 text-left align-bottom shadow-2xl backdrop-blur-sm transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle"
            >
                <form @submit.prevent="handleSubmit">
                    <div class="bg-gradient-to-br from-red-50/50 to-pink-50/50 px-6 pb-4 pt-6 sm:p-8 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-r from-red-400 to-pink-500 shadow-lg sm:mx-0"
                            >
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"
                                    />
                                </svg>
                            </div>
                            <div class="mt-4 w-full text-center sm:ml-6 sm:mt-0 sm:text-left">
                                <h3 class="mb-3 text-2xl font-bold text-gray-900" id="modal-title">Cancelar Solicitação</h3>

                                <div class="mt-2">
                                    <div class="mb-6 rounded-2xl border border-red-100 bg-white/70 p-4">
                                        <p class="mb-2 text-sm text-gray-700">
                                            <strong>Você tem certeza que deseja cancelar esta solicitação?</strong>
                                        </p>
                                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <svg class="mr-2 h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                    />
                                                </svg>
                                                <span class="font-medium">{{ request?.requester_name }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="mr-2 h-4 w-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                </svg>
                                                <span class="font-medium">{{ request?.destination }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Motivo do Cancelamento -->
                                    <div class="space-y-2">
                                        <label for="cancellation_reason" class="block text-sm font-semibold text-gray-700">
                                            <svg class="mr-2 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                />
                                            </svg>
                                            Motivo do Cancelamento *
                                        </label>
                                        <textarea
                                            id="cancellation_reason"
                                            v-model="form.cancellation_reason"
                                            rows="4"
                                            required
                                            placeholder="Por favor, informe o motivo do cancelamento desta solicitação de viagem..."
                                            class="block w-full resize-none rounded-xl border border-gray-200 bg-white/70 px-4 py-3 text-base placeholder-gray-400 shadow-sm backdrop-blur-sm transition-all duration-200 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.cancellation_reason }"
                                        ></textarea>
                                        <p v-if="errors.cancellation_reason" class="mt-2 flex items-center text-sm text-red-600">
                                            <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            {{ errors.cancellation_reason[0] }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Error Message -->
                                <div v-if="errorMessage" class="mt-6 rounded-2xl border border-red-200 bg-gradient-to-r from-red-50 to-pink-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-r from-red-400 to-pink-500"
                                            >
                                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-semibold text-red-800">{{ errorMessage }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 sm:flex sm:flex-row-reverse sm:space-x-3 sm:space-x-reverse sm:px-8"
                    >
                        <button
                            type="submit"
                            :disabled="loading"
                            class="group inline-flex w-full transform items-center justify-center rounded-xl border border-transparent bg-gradient-to-r from-red-500 to-pink-500 px-6 py-3 text-base font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-red-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 sm:w-auto sm:text-sm"
                        >
                            <svg
                                v-if="loading"
                                class="-ml-1 mr-3 h-5 w-5 animate-spin text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                ></path>
                            </svg>
                            <svg
                                v-if="!loading"
                                class="mr-2 h-5 w-5 transition-transform duration-200 group-hover:scale-110"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            {{ loading ? 'Cancelando...' : 'Confirmar Cancelamento' }}
                        </button>
                        <button
                            type="button"
                            @click="$emit('close')"
                            class="mt-3 inline-flex w-full transform items-center justify-center rounded-xl border-2 border-gray-300 bg-white px-6 py-3 text-base font-medium text-gray-700 shadow-sm transition-all duration-200 hover:scale-105 hover:border-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm"
                        >
                            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Voltar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useTravelRequests } from '@/composables/useTravelRequests';
import { reactive, ref, watch } from 'vue';

interface Props {
    show: boolean;
    request?: any;
}

interface Emits {
    (e: 'close'): void;
    (e: 'cancelled'): void;
}

const props = defineProps<Props>();
const emit = defineEmits<Emits>();

const travelRequestsStore = useTravelRequests();

const loading = ref(false);
const errorMessage = ref('');
const errors = ref<Record<string, string[]>>({});

const form = reactive({
    cancellation_reason: '',
});

const resetForm = () => {
    form.cancellation_reason = '';
    errors.value = {};
    errorMessage.value = '';
};

const handleSubmit = async () => {
    if (!props.request) return;

    loading.value = true;
    errors.value = {};
    errorMessage.value = '';

    try {
        await travelRequestsStore.updateStatus(props.request.id, {
            status: 'cancelled',
            cancellation_reason: form.cancellation_reason,
        });

        emit('cancelled');
        resetForm();
    } catch (error: any) {
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors || {};
            errorMessage.value = error.response.data.message || 'Dados inválidos';
        } else {
            errorMessage.value = error.response?.data?.message || 'Erro interno do servidor';
        }
    } finally {
        loading.value = false;
    }
};

// Watch for prop changes
watch(
    () => props.show,
    (show) => {
        if (show) {
            resetForm();
        }
    },
);
</script>

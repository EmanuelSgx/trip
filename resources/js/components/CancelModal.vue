<template>
  <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-gradient-to-br from-red-900/20 to-pink-900/20 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="$emit('close')"></div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div class="inline-block align-bottom bg-white/95 backdrop-blur-sm rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-white/20">
        <form @submit.prevent="handleSubmit">
          <div class="bg-gradient-to-br from-red-50/50 to-pink-50/50 px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-2xl bg-gradient-to-r from-red-400 to-pink-500 shadow-lg sm:mx-0">
                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
              </div>
              <div class="mt-4 text-center sm:mt-0 sm:ml-6 sm:text-left w-full">
                <h3 class="text-2xl font-bold text-gray-900 mb-3" id="modal-title">
                  Cancelar Solicitação
                </h3>
                
                <div class="mt-2">
                  <div class="bg-white/70 rounded-2xl p-4 mb-6 border border-red-100">
                    <p class="text-sm text-gray-700 mb-2">
                      <strong>Você tem certeza que deseja cancelar esta solicitação?</strong>
                    </p>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                      <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-medium">{{ request?.requester_name }}</span>
                      </div>
                      <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="font-medium">{{ request?.destination }}</span>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Motivo do Cancelamento -->
                  <div class="space-y-2">
                    <label for="cancellation_reason" class="block text-sm font-semibold text-gray-700">
                      <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                      </svg>
                      Motivo do Cancelamento *
                    </label>
                    <textarea
                      id="cancellation_reason"
                      v-model="form.cancellation_reason"
                      rows="4"
                      required
                      placeholder="Por favor, informe o motivo do cancelamento desta solicitação de viagem..."
                      class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white/70 backdrop-blur-sm transition-all duration-200 resize-none"
                      :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.cancellation_reason }"
                    ></textarea>
                    <p v-if="errors.cancellation_reason" class="mt-2 text-sm text-red-600 flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                      </svg>
                      {{ errors.cancellation_reason[0] }}
                    </p>
                  </div>
                </div>

                <!-- Error Message -->
                <div v-if="errorMessage" class="mt-6 rounded-2xl bg-gradient-to-r from-red-50 to-pink-50 p-4 border border-red-200">
                  <div class="flex">
                    <div class="flex-shrink-0">
                      <div class="w-8 h-8 bg-gradient-to-r from-red-400 to-pink-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
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
          
          <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 sm:px-8 sm:flex sm:flex-row-reverse sm:space-x-reverse sm:space-x-3">
            <button
              type="submit"
              :disabled="loading"
              class="group w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-lg px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-base font-semibold text-white hover:from-red-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105"
            >
              <svg
                v-if="loading"
                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
              >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <svg v-if="!loading" class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
              {{ loading ? 'Cancelando...' : 'Confirmar Cancelamento' }}
            </button>
            <button
              type="button"
              @click="$emit('close')"
              class="mt-3 w-full inline-flex justify-center items-center rounded-xl border-2 border-gray-300 shadow-sm px-6 py-3 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition-all duration-200 transform hover:scale-105"
            >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
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
import { ref, reactive, watch } from 'vue'
import { useTravelRequests } from '@/composables/useTravelRequests'

interface Props {
  show: boolean
  request?: any
}

interface Emits {
  (e: 'close'): void
  (e: 'cancelled'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const travelRequestsStore = useTravelRequests()

const loading = ref(false)
const errorMessage = ref('')
const errors = ref<Record<string, string[]>>({})

const form = reactive({
  cancellation_reason: ''
})

const resetForm = () => {
  form.cancellation_reason = ''
  errors.value = {}
  errorMessage.value = ''
}

const handleSubmit = async () => {
  if (!props.request) return

  loading.value = true
  errors.value = {}
  errorMessage.value = ''

  try {
    await travelRequestsStore.updateStatus(props.request.id, {
      status: 'cancelled',
      cancellation_reason: form.cancellation_reason
    })
    
    emit('cancelled')
    resetForm()
  } catch (error: any) {
    if (error.response?.status === 422) {
      errors.value = error.response.data.errors || {}
      errorMessage.value = error.response.data.message || 'Dados inválidos'
    } else {
      errorMessage.value = error.response?.data?.message || 'Erro interno do servidor'
    }
  } finally {
    loading.value = false
  }
}

// Watch for prop changes
watch(() => props.show, (show) => {
  if (show) {
    resetForm()
  }
})
</script>

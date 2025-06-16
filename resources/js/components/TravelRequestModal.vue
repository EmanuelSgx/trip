<template>
  <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-gradient-to-br from-blue-900/20 to-indigo-900/20 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="$emit('close')"></div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div class="inline-block align-bottom bg-white/95 backdrop-blur-sm rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-white/20">
        <form @submit.prevent="handleSubmit">
          <div class="bg-gradient-to-br from-blue-50/50 to-indigo-50/50 px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="w-full">
                <div class="flex items-center space-x-3 mb-6">
                  <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                  </div>
                  <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent" id="modal-title">
                    {{ isEditing ? 'Editar Solicitação' : 'Nova Solicitação de Viagem' }}
                  </h3>
                </div>
                
                <div class="grid grid-cols-1 gap-6">
                  <!-- Nome do Solicitante -->
                  <div class="space-y-2">
                    <label for="requester_name" class="block text-sm font-semibold text-gray-700">
                      <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                      </svg>
                      Nome do Solicitante
                    </label>
                    <input
                      id="requester_name"
                      v-model="form.requester_name"
                      type="text"
                      required
                      placeholder="Digite o nome completo do solicitante"
                      class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 backdrop-blur-sm transition-all duration-200"
                      :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.requester_name }"
                    />
                    <p v-if="errors.requester_name" class="mt-2 text-sm text-red-600 flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                      </svg>
                      {{ errors.requester_name[0] }}
                    </p>
                  </div>

                  <!-- Destino -->
                  <div class="space-y-2">
                    <label for="destination" class="block text-sm font-semibold text-gray-700">
                      <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                      </svg>
                      Destino da Viagem
                    </label>
                    <input
                      id="destination"
                      v-model="form.destination"
                      type="text"
                      required
                      placeholder="Ex: São Paulo, Rio de Janeiro, Brasília"
                      class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 backdrop-blur-sm transition-all duration-200"
                      :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.destination }"
                    />
                    <p v-if="errors.destination" class="mt-2 text-sm text-red-600 flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                      </svg>
                      {{ errors.destination[0] }}
                    </p>
                  </div>

                  <!-- Datas -->
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Data de Ida -->
                    <div class="space-y-2">
                      <label for="departure_date" class="block text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Data de Ida
                      </label>
                      <input
                        id="departure_date"
                        v-model="form.departure_date"
                        type="date"
                        required
                        :min="tomorrow"
                        class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 backdrop-blur-sm transition-all duration-200"
                        :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.departure_date }"
                      />
                      <p v-if="errors.departure_date" class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ errors.departure_date[0] }}
                      </p>
                    </div>

                    <!-- Data de Volta -->
                    <div class="space-y-2">
                      <label for="return_date" class="block text-sm font-semibold text-gray-700">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Data de Volta
                      </label>
                      <input
                        id="return_date"
                        v-model="form.return_date"
                        type="date"
                        required
                        :min="form.departure_date || tomorrow"
                        class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 backdrop-blur-sm transition-all duration-200"
                        :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.return_date }"
                      />
                      <p v-if="errors.return_date" class="mt-2 text-sm text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ errors.return_date[0] }}
                      </p>
                    </div>
                  </div>

                  <!-- Observações -->
                  <div class="space-y-2">
                    <label for="notes" class="block text-sm font-semibold text-gray-700">
                      <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                      </svg>
                      Observações
                      <span class="text-gray-400 font-normal">(opcional)</span>
                    </label>
                    <textarea
                      id="notes"
                      v-model="form.notes"
                      rows="4"
                      class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 backdrop-blur-sm transition-all duration-200 resize-none"
                      :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.notes }"
                      placeholder="Informações adicionais sobre a viagem, como objetivo, hospedagem, transporte, etc."
                    ></textarea>
                    <p v-if="errors.notes" class="mt-2 text-sm text-red-600 flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                      </svg>
                      {{ errors.notes[0] }}
                    </p>
                  </div>                  <!-- Status (apenas para admin) -->
                  <div v-if="isAdmin" class="space-y-2">
                    <label for="status" class="block text-sm font-semibold text-gray-700">
                      <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>
                      Status da Solicitação
                    </label>
                    <select
                      id="status"
                      v-model="form.status"
                      required
                      class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 backdrop-blur-sm transition-all duration-200"
                      :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.status }"
                    >
                      <option value="pending">📋 Pendente</option>
                      <option value="approved">✅ Aprovado</option>
                      <option value="cancelled">❌ Cancelado</option>
                    </select>
                    <p v-if="errors.status" class="mt-2 text-sm text-red-600 flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                      </svg>
                      {{ errors.status[0] }}
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
              class="group w-full inline-flex justify-center items-center rounded-xl border border-transparent shadow-lg px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-base font-semibold text-white hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105"
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
              {{ loading ? 'Salvando...' : (isEditing ? 'Atualizar Solicitação' : 'Criar Solicitação') }}
            </button>
            <button
              type="button"
              @click="$emit('close')"
              class="mt-3 w-full inline-flex justify-center items-center rounded-xl border-2 border-gray-300 shadow-sm px-6 py-3 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition-all duration-200 transform hover:scale-105"
            >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
              Cancelar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, computed, watch } from 'vue'
import { useTravelRequests } from '@/composables/useTravelRequests'
import { useAuthStore } from '@/composables/useAuth'

interface Props {
  show: boolean
  request?: any
}

interface Emits {
  (e: 'close'): void
  (e: 'saved'): void
}

const props = defineProps<Props>()
const emit = defineEmits<Emits>()

const travelRequestsStore = useTravelRequests()
const authStore = useAuthStore()

const loading = ref(false)
const errorMessage = ref('')
const errors = ref<Record<string, string[]>>({})

const form = reactive({
  requester_name: '',
  destination: '',
  departure_date: '',
  return_date: '',
  notes: '',
  status: 'pending' // Define pending como padrão
})

const isEditing = computed(() => !!props.request)

const isAdmin = computed(() => authStore.user?.role === 'admin')

const tomorrow = computed(() => {
  const date = new Date()
  date.setDate(date.getDate() + 1)
  return date.toISOString().split('T')[0]
})

const resetForm = () => {
  form.requester_name = ''
  form.destination = ''
  form.departure_date = ''
  form.return_date = ''
  form.notes = ''
  form.status = 'pending' // Define pending como padrão
  errors.value = {}
  errorMessage.value = ''
}

const populateForm = (request: any) => {
  if (request) {
    form.requester_name = request.requester_name || ''
    form.destination = request.destination || ''
    form.departure_date = request.departure_date || ''
    form.return_date = request.return_date || ''
    form.notes = request.notes || ''
    form.status = request.status || 'pending'
  }
}

const handleSubmit = async () => {
  loading.value = true
  errors.value = {}
  errorMessage.value = ''

  try {
    if (isEditing.value) {
      await travelRequestsStore.updateRequest(props.request.id, form)
    } else {
      await travelRequestsStore.createRequest(form)
    }
    
    emit('saved')
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
    if (props.request) {
      populateForm(props.request)
    } else {
      resetForm()
    }
  }
})

// Watch for request changes
watch(() => props.request, (request) => {
  if (request && props.show) {
    populateForm(request)
  }
})
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-white/20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
          <div class="flex items-center space-x-3">
            <!-- Back Button -->
            <button
              @click="$router.push('/dashboard')"
              class="mr-4 p-2 text-gray-500 hover:text-blue-600 transition-colors duration-200"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
              </svg>
            </button>
            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
              Meu Perfil
            </h1>
          </div>
          <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
              </div>              <span class="text-sm font-medium text-gray-700">{{ user?.name || 'Carregando...' }}</span>
            </div>
          </div>
        </div>      </div>
    </header>

    <main class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <!-- Profile Form -->
      <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-3xl overflow-hidden border border-white/20">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
          <h2 class="text-2xl font-bold text-white flex items-center">
            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Informações do Perfil
          </h2>
          <p class="text-blue-100 mt-2">Atualize suas informações pessoais</p>
        </div>

        <form @submit.prevent="updateProfile" class="p-8 space-y-6">
          <!-- Name Field -->
          <div>
            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
              Nome Completo
            </label>
            <input
              v-model="profileForm.name"
              type="text"
              class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/50 backdrop-blur-sm transition-all duration-200"
              :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.name }"
              placeholder="Digite seu nome completo"
            />
            <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</p>
          </div>

          <!-- Email Field -->
          <div>
            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
              </svg>
              Email
            </label>
            <input
              v-model="profileForm.email"
              type="email"
              class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/50 backdrop-blur-sm transition-all duration-200"
              :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.email }"
              placeholder="Digite seu email"
            />
            <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
          </div>

          <!-- Current Password Field -->
          <div>
            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
              Senha Atual (deixe em branco para não alterar)
            </label>
            <input
              v-model="profileForm.current_password"
              type="password"
              class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/50 backdrop-blur-sm transition-all duration-200"
              :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.current_password }"
              placeholder="Digite sua senha atual"
            />
            <p v-if="errors.current_password" class="mt-1 text-sm text-red-600">{{ errors.current_password }}</p>
          </div>

          <!-- New Password Field -->
          <div v-if="profileForm.current_password">
            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
              </svg>
              Nova Senha
            </label>
            <input
              v-model="profileForm.password"
              type="password"
              class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/50 backdrop-blur-sm transition-all duration-200"
              :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.password }"
              placeholder="Digite a nova senha"
            />
            <p v-if="errors.password" class="mt-1 text-sm text-red-600">{{ errors.password }}</p>
          </div>

          <!-- Confirm Password Field -->
          <div v-if="profileForm.password">
            <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              Confirmar Nova Senha
            </label>
            <input
              v-model="profileForm.password_confirmation"
              type="password"
              class="block w-full px-4 py-3 text-base border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/50 backdrop-blur-sm transition-all duration-200"
              :class="{ 'border-red-300 focus:ring-red-500 focus:border-red-500': errors.password_confirmation }"
              placeholder="Confirme a nova senha"
            />
            <p v-if="errors.password_confirmation" class="mt-1 text-sm text-red-600">{{ errors.password_confirmation }}</p>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end space-x-4 pt-6">
            <button
              type="button"
              @click="$router.push('/dashboard')"
              class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200"
            >
              Cancelar
            </button>
            <button
              type="submit"
              :disabled="loading"
              class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ loading ? 'Salvando...' : 'Salvar Alterações' }}
            </button>
          </div>
        </form>      </div>    </main>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import { useAuthStore } from '@/composables/useAuth'
import { useToast } from '@/composables/useToast'

const { user, me: loadUser } = useAuthStore()
const toast = useToast()

const loading = ref(false)

const profileForm = reactive({
  name: '',
  email: '',
  current_password: '',
  password: '',
  password_confirmation: ''
})

const errors = reactive({
  name: '',
  email: '',
  current_password: '',
  password: '',
  password_confirmation: ''
})

const clearErrors = () => {
  Object.keys(errors).forEach(key => {
    errors[key as keyof typeof errors] = ''
  })
}

const updateProfile = async () => {
  loading.value = true
  clearErrors()

  try {
    const token = localStorage.getItem('auth_token')
    if (!token) {
      throw new Error('Token não encontrado')
    }

    const payload: any = {
      name: profileForm.name,
      email: profileForm.email
    }

    // Only include password fields if current_password is provided
    if (profileForm.current_password) {
      payload.current_password = profileForm.current_password
      payload.password = profileForm.password
      payload.password_confirmation = profileForm.password_confirmation
    }

    const response = await fetch('http://localhost:8000/api/profile', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      },
      body: JSON.stringify(payload)    })

    const data = await response.json()
    
    if (response.ok) {
      toast.success('Perfil atualizado com sucesso!')
      // Clear password fields
      profileForm.current_password = ''
      profileForm.password = ''
      profileForm.password_confirmation = ''
      // Reload user data
      await loadUser()
    } else {
      if (data.errors) {
        Object.keys(data.errors).forEach(key => {
          if (key in errors) {
            errors[key as keyof typeof errors] = data.errors[key][0]
          }
        })
      } else {
        throw new Error(data.message || 'Erro ao atualizar perfil')
      }
    }  } catch (error) {
    toast.error('Erro ao atualizar perfil')
  } finally {
    loading.value = false
  }
}

onMounted(async () => {
  try {
    // Load user data from API
    await loadUser()
    
    // Populate form with user data
    if (user.value) {
      profileForm.name = user.value.name || ''
      profileForm.email = user.value.email || ''
    }
  } catch (error) {
    toast.error('Erro ao carregar dados do usuário')
  }
})
</script>

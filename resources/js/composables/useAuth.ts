import { ref, computed } from 'vue'
import axios from 'axios'
import type { User, AuthData } from '@/types'

// State
const user = ref<User | null>(null)
const token = ref<string | null>(localStorage.getItem('auth_token'))
const isLoading = ref(false)

// Load user from localStorage if available
const storedUser = localStorage.getItem('user')
if (storedUser) {
  user.value = JSON.parse(storedUser)
}

// Configure axios defaults
if (token.value) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`
}

// Configure axios base URL
axios.defaults.baseURL = 'http://localhost:8000'

export function useAuthStore() {
  const isAuthenticated = computed(() => !!token.value && !!user.value)
  const setAuthData = (authData: AuthData) => {
    user.value = authData.user
    token.value = authData.authorization.token
    
    localStorage.setItem('auth_token', authData.authorization.token)
    localStorage.setItem('user', JSON.stringify(authData.user))
    
    axios.defaults.headers.common['Authorization'] = `Bearer ${authData.authorization.token}`
  }

  const clearAuthData = () => {
    user.value = null
    token.value = null
    
    localStorage.removeItem('auth_token')
    localStorage.removeItem('user')
    
    delete axios.defaults.headers.common['Authorization']
  }

  const login = async (email: string, password: string) => {
    isLoading.value = true
    try {
      const response = await axios.post('/api/auth/login', {
        email,
        password
      })

      if (response.data.success) {
        setAuthData(response.data)
        return response.data
      } else {
        throw new Error(response.data.message || 'Login failed')
      }
    } catch (error: any) {
      clearAuthData()
      throw error
    } finally {
      isLoading.value = false
    }
  }
  const register = async (userData: any) => {
    isLoading.value = true
    try {
      const response = await axios.post('/api/auth/register', userData)

      if (response.data.success) {
        setAuthData(response.data)
        return { success: true, data: response.data }
      } else {
        return {
          success: false,
          message: response.data.message || 'Registration failed',
          errors: response.data.errors
        }
      }
    } catch (error: any) {
      console.error('Registration error:', error)
      if (error.response?.status === 422) {
        return {
          success: false,
          message: error.response.data.message || 'Dados inválidos',
          errors: error.response.data.errors
        }
      } else {
        return {
          success: false,
          message: 'Erro interno do servidor'
        }
      }
    } finally {
      isLoading.value = false
    }
  }

  const logout = async () => {
    isLoading.value = true
    try {
      if (token.value) {
        await axios.post('/api/auth/logout')
      }
    } catch (error) {
      console.error('Logout error:', error)
    } finally {      clearAuthData()
      isLoading.value = false
    }
  }
  
  const me = async () => {
    try {
      const response = await axios.get('/api/auth/me')
      
      if (response.data.success) {
        user.value = response.data.user
        
        // Also update localStorage
        localStorage.setItem('user', JSON.stringify(response.data.user))
        
        return response.data.user
      } else {
        throw new Error('Failed to get user data')
      }
    } catch (error) {
      clearAuthData()
      throw error
    }
  }

  const refresh = async () => {
    try {
      const response = await axios.post('/api/auth/refresh')
      if (response.data.success) {
        setAuthData(response.data)
        return response.data
      }
    } catch (error) {
      clearAuthData()
      throw error
    }
  }  // Initialize user from localStorage
  const initializeAuth = () => {
    const storedUser = localStorage.getItem('user')
    const storedToken = localStorage.getItem('auth_token')
    
    if (storedUser && storedToken) {
      try {
        const parsedUser = JSON.parse(storedUser)
        user.value = parsedUser
        token.value = storedToken
        axios.defaults.headers.common['Authorization'] = `Bearer ${storedToken}`
      } catch (error) {
        clearAuthData()
      }
    }
  }

  // Initialize on load
  initializeAuth()

  return {
    user: computed(() => user.value),
    token: computed(() => token.value),
    isAuthenticated,
    isLoading: computed(() => isLoading.value),
    login,
    register,
    logout,
    me,
    refresh,
    initializeAuth,
    setAuthData,
    clearAuthData
  }
}

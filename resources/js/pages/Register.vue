<template>
    <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="flex justify-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 shadow-xl">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                            />
                        </svg>
                    </div>
                </div>
                <h2 class="mt-6 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-3xl font-bold text-transparent">Criar Conta</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Ou
                    <router-link to="/login" class="font-medium text-blue-600 transition-colors duration-200 hover:text-blue-500">
                        faça login na sua conta existente
                    </router-link>
                </p>
            </div>

            <!-- Formulário -->
            <form @submit.prevent="handleRegister" class="mt-8 space-y-6">
                <div class="rounded-3xl border border-white/20 bg-white/70 p-8 shadow-xl backdrop-blur-sm">
                    <div class="space-y-6">
                        <!-- Nome -->
                        <div>
                            <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                        />
                                    </svg>
                                    <span>Nome Completo</span>
                                </div>
                            </label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                required
                                class="w-full rounded-xl border border-gray-200 bg-white/80 px-4 py-3 backdrop-blur-sm transition-all duration-200 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-300': errors.name }"
                                placeholder="Digite seu nome completo"
                            />
                            <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name[0] }}</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
                                        />
                                    </svg>
                                    <span>Email</span>
                                </div>
                            </label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                required
                                class="w-full rounded-xl border border-gray-200 bg-white/80 px-4 py-3 backdrop-blur-sm transition-all duration-200 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-300': errors.email }"
                                placeholder="Digite seu email"
                            />
                            <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email[0] }}</p>
                        </div>

                        <!-- Senha -->
                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                        />
                                    </svg>
                                    <span>Senha</span>
                                </div>
                            </label>
                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                required
                                class="w-full rounded-xl border border-gray-200 bg-white/80 px-4 py-3 backdrop-blur-sm transition-all duration-200 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-300': errors.password }"
                                placeholder="Digite sua senha (mín. 6 caracteres)"
                            />
                            <p v-if="errors.password" class="mt-1 text-sm text-red-600">{{ errors.password[0] }}</p>
                        </div>

                        <!-- Confirmar Senha -->
                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                    <span>Confirmar Senha</span>
                                </div>
                            </label>
                            <input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                required
                                class="w-full rounded-xl border border-gray-200 bg-white/80 px-4 py-3 backdrop-blur-sm transition-all duration-200 focus:border-transparent focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-300': errors.password_confirmation }"
                                placeholder="Confirme sua senha"
                            />
                            <p v-if="errors.password_confirmation" class="mt-1 text-sm text-red-600">{{ errors.password_confirmation[0] }}</p>
                        </div>
                    </div>

                    <!-- Botão de Cadastro -->
                    <div class="mt-8">
                        <button
                            type="submit"
                            :disabled="loading"
                            class="group relative flex w-full transform justify-center rounded-xl border border-transparent bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 text-sm font-medium text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-blue-700 hover:to-indigo-700 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:transform-none disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg
                                    v-if="loading"
                                    class="h-5 w-5 animate-spin text-white"
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
                                    v-else
                                    class="h-5 w-5 text-blue-300 group-hover:text-blue-200"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                                    />
                                </svg>
                            </span>
                            {{ loading ? 'Criando conta...' : 'Criar Conta' }}
                        </button>
                    </div>
                </div>
            </form>

            <!-- Links adicionais -->
            <div class="text-center">
                <div class="text-sm text-gray-600">
                    <span>Já tem uma conta? </span>
                    <router-link to="/login" class="font-medium text-blue-600 transition-colors duration-200 hover:text-blue-500">
                        Faça login aqui
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/composables/useAuth';
import { useToast } from '@/composables/useToast';
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const { register } = useAuthStore();
const toast = useToast();

const loading = ref(false);

const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const errors = reactive({
    name: null as string[] | null,
    email: null as string[] | null,
    password: null as string[] | null,
    password_confirmation: null as string[] | null,
});

const clearErrors = () => {
    errors.name = null;
    errors.email = null;
    errors.password = null;
    errors.password_confirmation = null;
};

const handleRegister = async () => {
    loading.value = true;
    clearErrors();

    try {
        const result = await register(form);

        if (result.success) {
            toast.success('Conta criada com sucesso! Bem-vindo!');
            router.push('/dashboard');
        } else {
            if (result.errors) {
                Object.keys(result.errors).forEach((key) => {
                    if (key in errors) {
                        errors[key as keyof typeof errors] = result.errors[key];
                    }
                });
            }
            toast.error(result.message || 'Erro ao criar conta');
        }
    } catch (error) {
        console.error('Registration error:', error);
        toast.error('Erro interno. Tente novamente.');
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <!-- Header -->
        <header class="border-b border-white/20 bg-white/80 shadow-lg backdrop-blur-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-6">
                    <div class="flex items-center space-x-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 shadow-lg">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </div>
                        <h1 class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-3xl font-bold text-transparent">TripTech</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-indigo-500">
                                <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-700">{{ user?.name }}</span>
                                    <span
                                        v-if="user?.role === 'admin'"
                                        class="inline-flex animate-pulse items-center rounded-full bg-gradient-to-r from-red-500 to-pink-500 px-3 py-1 text-xs font-bold text-white shadow-lg"
                                    >
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                            />
                                        </svg>
                                        ADMINISTRADOR
                                    </span>
                                    <span
                                        v-else-if="user?.role === 'user'"
                                        class="inline-flex items-center rounded-full border border-blue-200 bg-gradient-to-r from-blue-100 to-indigo-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                    >
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                        USUÁRIO
                                    </span>
                                    <span
                                        v-else
                                        class="inline-flex items-center rounded-full border border-gray-300 bg-gradient-to-r from-gray-100 to-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-600"
                                    >
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        CARREGANDO...
                                    </span>
                                </div>
                                <div class="mt-1 text-xs text-gray-500">
                                    {{ user?.email }}
                                </div>
                            </div>
                        </div>
                        <!-- Botões do Header - Perfil e Sair -->
                        <button
                            @click="router.push('/profile')"
                            class="group relative mr-3 inline-flex min-w-0 transform items-center justify-center rounded-lg bg-gradient-to-r from-blue-500 to-indigo-500 px-4 py-2 font-medium text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-blue-600 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:px-5 sm:py-3"
                        >
                            <svg
                                class="mr-2 h-4 w-4 flex-shrink-0 transition-transform duration-200 group-hover:scale-110 sm:h-5 sm:w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                />
                            </svg>
                            <span class="whitespace-nowrap text-sm font-bold tracking-wide sm:text-base">
                                <span v-if="user?.role === 'admin'">PERFIL</span>
                                <span v-else>Perfil</span>
                            </span>
                        </button>
                        <button
                            @click="handleLogout"
                            class="group relative inline-flex min-w-0 transform items-center justify-center rounded-lg bg-gradient-to-r from-red-500 to-pink-500 px-4 py-2 font-medium text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-red-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:px-5 sm:py-3"
                        >
                            <svg
                                class="mr-2 h-4 w-4 flex-shrink-0 transition-transform duration-200 group-hover:rotate-12 sm:h-5 sm:w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />
                            </svg>
                            <span class="whitespace-nowrap text-sm font-bold tracking-wide sm:text-base">
                                <span v-if="user?.role === 'admin'">SAIR</span>
                                <span v-else>Sair</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl py-8 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8 rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="mb-2 text-3xl font-bold">
                            👋 Bem-vindo{{ user?.name?.includes('Administrador') ? ', ' + user?.name : user?.name ? ', ' + user.name : '' }}!
                        </h2>
                        <p class="mb-4 text-lg text-blue-100">
                            {{
                                user?.role === 'admin'
                                    ? 'Você está no painel administrativo. Gerencie todas as solicitações de viagem da empresa.'
                                    : 'Gerencie suas solicitações de viagem de forma fácil e rápida.'
                            }}
                        </p>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="h-3 w-3 animate-pulse rounded-full bg-green-400"></div>
                                <span class="text-sm">Sistema Online</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-sm">Última atualização: {{ new Date().toLocaleString('pt-BR') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex h-32 w-32 items-center justify-center rounded-full bg-white/10">
                            <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    class="group transform overflow-hidden rounded-2xl border border-white/20 bg-white/80 shadow-xl backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-blue-500 to-indigo-500 shadow-lg transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-600">Total de Solicitações</dt>
                                    <dd class="text-2xl font-bold text-gray-900 transition-colors duration-300 group-hover:text-blue-600">
                                        {{ stats.total }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="group transform overflow-hidden rounded-2xl border border-white/20 bg-white/80 shadow-xl backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-yellow-400 to-orange-500 shadow-lg transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-600">Pendentes</dt>
                                    <dd class="text-2xl font-bold text-gray-900 transition-colors duration-300 group-hover:text-yellow-600">
                                        {{ stats.pending }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="group transform overflow-hidden rounded-2xl border border-white/20 bg-white/80 shadow-xl backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-green-400 to-emerald-500 shadow-lg transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-600">Aprovadas</dt>
                                    <dd class="text-2xl font-bold text-gray-900 transition-colors duration-300 group-hover:text-green-600">
                                        {{ stats.approved }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="group transform overflow-hidden rounded-2xl border border-white/20 bg-white/80 shadow-xl backdrop-blur-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-red-400 to-pink-500 shadow-lg transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="truncate text-sm font-medium text-gray-600">Canceladas</dt>
                                    <dd class="text-2xl font-bold text-gray-900 transition-colors duration-300 group-hover:text-red-600">
                                        {{ stats.cancelled }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Panel (only visible for admins) -->
            <div
                v-if="user?.role === 'admin'"
                class="mb-8 overflow-hidden rounded-2xl border-2 border-red-200 bg-gradient-to-r from-red-50 to-pink-50 shadow-xl"
            >
                <div class="bg-gradient-to-r from-red-500 to-pink-500 px-6 py-3">
                    <div class="flex items-center space-x-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/20">
                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white">🛡️ Painel do Administrador</h3>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="flex items-center space-x-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-r from-blue-500 to-indigo-500">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Visualização Completa</p>
                                <p class="text-xs text-gray-500">Você pode ver todas as solicitações de todos os usuários</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-r from-green-500 to-emerald-500">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Aprovação de Solicitações</p>
                                <p class="text-xs text-gray-500">Você pode aprovar ou rejeitar qualquer solicitação</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Actions -->
            <div class="mb-8 rounded-2xl border border-white/20 bg-white/80 shadow-xl backdrop-blur-sm">
                <div>
                    <div class="lg:items-center flex flex-col space-y-10 lg:flex-row lg:items-end lg:justify-between lg:space-y-0 lg:space-x-12">
                        <!-- Filtros Section -->
                        <div class="flex-1 pr-4 lg:pr-6 ">
                            <div class="rounded-xl bg-gray-50/50 p-6 backdrop-blur-sm">
                                <h3 class="mb-4 text-lg font-semibold text-gray-800">
                                    🔍 Filtros de Busca
                                </h3>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-6">
                                <!-- Status Filter -->
                                <div class="space-y-2">
                                    <label for="status-filter" class="block text-sm font-semibold text-gray-700">
                                        <svg class="mr-1 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                            />
                                        </svg>
                                        Filtrar por Status
                                    </label>
                                    <select
                                        id="status-filter"
                                        v-model="filters.status"
                                        @change="loadRequests()"
                                        class="block w-full rounded-xl border border-gray-200 bg-white/50 px-4 py-3 text-base shadow-sm backdrop-blur-sm transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    >
                                        <option value="">📋 Todos os Status</option>
                                        <option value="pending">⏳ Pendente</option>
                                        <option value="approved">✅ Aprovado</option>
                                        <option value="cancelled">❌ Cancelado</option>
                                    </select>
                                </div>

                                <!-- Destination Filter -->
                                <div class="space-y-2">
                                    <label for="destination-filter" class="block text-sm font-semibold text-gray-700">
                                        <svg class="mr-1 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                            />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Buscar Destino
                                    </label>
                                    <input
                                        id="destination-filter"
                                        v-model="filters.destination"
                                        @input="debouncedLoadRequests"
                                        type="text"
                                        placeholder="🌍 Ex: São Paulo, Rio de Janeiro..."
                                        class="block w-full rounded-xl border border-gray-200 bg-white/50 px-4 py-3 text-base placeholder-gray-400 shadow-sm backdrop-blur-sm transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>

                                <!-- Date Filters -->
                                <div class="space-y-2">
                                    <label for="date-from" class="block text-sm font-semibold text-gray-700">
                                        <svg class="mr-1 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>
                                        📅 Data Início
                                    </label>
                                    <input
                                        id="date-from"
                                        v-model="filters.dateFrom"
                                        @change="loadRequests()"
                                        type="date"
                                        class="block w-full rounded-xl border border-gray-200 bg-white/50 px-4 py-3 text-base shadow-sm backdrop-blur-sm transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>

                                <div class="space-y-2">
                                    <label for="date-to" class="block text-sm font-semibold text-gray-700">
                                        <svg class="mr-1 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>
                                        📅 Data Fim
                                    </label>
                                    <input
                                        id="date-to"
                                        v-model="filters.dateTo"
                                        @change="loadRequests()"
                                        type="date"
                                        class="block w-full rounded-xl border border-gray-200 bg-white/50 px-4 py-3 text-base shadow-sm backdrop-blur-sm transition-all duration-200 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons Section - Grid 2x2 com melhor separação -->
                        <div class="flex-shrink-0 pl-4 lg:pl-6">
                            <div class="rounded-xl bg-gradient-to-br from-blue-50/60 to-indigo-50/60 p-6 backdrop-blur-sm">
                                <h3 class="mb-4 text-center text-lg font-semibold text-gray-800">
                                    ⚡ Ações Rápidas
                                </h3>
                                <div class="grid grid-cols-2 gap-4 lg:gap-5">
                                <!-- Linha Superior -->
                                <!-- Botão Notificar Pendentes (apenas admin) - Superior Esquerda -->
                                <button
                                    v-if="user?.role === 'admin'"
                                    @click="notifyPendingRequests"
                                    class="group relative inline-flex w-20 transform flex-col items-center justify-center rounded-xl bg-gradient-to-r from-purple-500 to-indigo-500 px-2 py-2.5 font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-purple-600 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 sm:w-24 sm:px-3 sm:py-3"
                                >
                                    <svg
                                        class="mb-1 h-4 w-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 sm:h-5 sm:w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 17h5l-5 5v-5zM12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                    <span class="text-center text-xs font-bold leading-tight tracking-wide sm:text-sm">
                                        🔔<br />AVISAR
                                    </span>
                                </button>

                                <!-- Botão Limpar Filtros - Superior Direita -->
                                <button
                                    @click="clearFilters"
                                    class="group relative inline-flex w-20 transform flex-col items-center justify-center rounded-xl bg-gradient-to-r from-gray-500 to-gray-600 px-2 py-2.5 font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-gray-600 hover:to-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 sm:w-24 sm:px-3 sm:py-3"
                                >
                                    <svg
                                        class="mb-1 h-4 w-4 flex-shrink-0 transition-transform duration-300 group-hover:rotate-180 sm:h-5 sm:w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                        />
                                    </svg>
                                    <span class="text-center text-xs font-bold leading-tight tracking-wide sm:text-sm">
                                        <span v-if="user?.role === 'admin'">🔄<br />LIMPAR</span>
                                        <span v-else>🔄<br />Limpar</span>
                                    </span>
                                </button>

                                <!-- Linha Inferior -->
                                <!-- Botão Exportar CSV - Inferior Esquerda -->
                                <button
                                    @click="exportRequests"
                                    :disabled="!requests.data || requests.data.length === 0"
                                    class="group relative inline-flex w-20 transform flex-col items-center justify-center rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 px-2 py-2.5 font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-green-600 hover:to-emerald-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:scale-100 sm:w-24 sm:px-3 sm:py-3"
                                >
                                    <svg
                                        class="mb-1 h-4 w-4 flex-shrink-0 transition-transform duration-300 group-hover:scale-110 sm:h-5 sm:w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                    <span class="text-center text-xs font-bold leading-tight tracking-wide sm:text-sm">
                                        <span v-if="user?.role === 'admin'">📊<br />DADOS</span>
                                        <span v-else>📊<br />Dados</span>
                                    </span>
                                </button>

                                <!-- Botão Nova Solicitação - Inferior Direita -->
                                <button
                                    @click="showCreateModal = true"
                                    class="group relative inline-flex w-20 transform flex-col items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-2 py-2.5 font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-24 sm:px-3 sm:py-3"
                                >
                                    <svg
                                        class="mb-1 h-4 w-4 flex-shrink-0 transition-transform duration-300 group-hover:rotate-90 sm:h-5 sm:w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span class="text-center text-xs font-bold leading-tight tracking-wide sm:text-sm">
                                        <span v-if="user?.role === 'admin'">✈️<br />CRIAR</span>
                                        <span v-else>✈️<br />Criar</span>
                                    </span>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Travel Requests Table -->
            <div class="overflow-hidden rounded-2xl border border-white/20 bg-white/80 shadow-xl backdrop-blur-sm">
                <div v-if="loading" class="p-8 text-center">
                    <div class="inline-flex items-center justify-center">
                        <div class="h-8 w-8 animate-spin rounded-full border-4 border-blue-200 border-t-blue-600"></div>
                        <span class="ml-3 font-medium text-gray-600">Carregando solicitações...</span>
                    </div>
                </div>

                <div v-else-if="requests.data && requests.data.length">
                    <ul role="list" class="divide-y divide-gray-100">
                        <li
                            v-for="request in requests.data"
                            :key="request.id"
                            class="group px-6 py-6 transition-all duration-200 hover:bg-blue-50/50"
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex min-w-0 flex-1 items-center">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-2xl shadow-lg transition-all duration-300 group-hover:scale-110"
                                            :class="{
                                                'bg-gradient-to-r from-yellow-400 to-orange-500': request.status === 'pending',
                                                'bg-gradient-to-r from-green-400 to-emerald-500': request.status === 'approved',
                                                'bg-gradient-to-r from-red-400 to-pink-500': request.status === 'cancelled',
                                            }"
                                        >
                                            <svg
                                                v-if="request.status === 'pending'"
                                                class="h-6 w-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />
                                            </svg>
                                            <svg
                                                v-else-if="request.status === 'approved'"
                                                class="h-6 w-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <svg v-else class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-6 min-w-0 flex-1">
                                        <div class="mb-2 flex items-center space-x-3">
                                            <div class="flex items-center space-x-2">
                                                <span
                                                    class="inline-flex items-center rounded-md border bg-gray-100 px-2 py-1 font-mono text-xs font-bold text-gray-600"
                                                >
                                                    #{{ request.id }}
                                                </span>
                                                <h3 class="truncate text-lg font-semibold text-gray-900">
                                                    {{ request.requester_name }}
                                                </h3>
                                            </div>
                                            <span
                                                class="inline-flex cursor-pointer items-center rounded-full px-3 py-1 text-xs font-medium shadow-sm transition-all duration-200"
                                                :class="{
                                                    'border border-yellow-200 bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 hover:from-yellow-200 hover:to-orange-200':
                                                        request.status === 'pending',
                                                    'border border-green-200 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 hover:from-green-200 hover:to-emerald-200':
                                                        request.status === 'approved',
                                                    'border border-red-200 bg-gradient-to-r from-red-100 to-pink-100 text-red-800 hover:from-red-200 hover:to-pink-200':
                                                        request.status === 'cancelled',
                                                }"
                                                @click.stop="testClick(request)"
                                                :style="{ cursor: user?.role === 'admin' ? 'pointer' : 'default' }"
                                                :title="user?.role === 'admin' ? 'Clique para alterar o status' : ''"
                                            >
                                                {{ getStatusLabel(request.status) }}
                                                <svg
                                                    v-if="user?.role === 'admin'"
                                                    class="ml-1 h-3 w-3 opacity-60"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="mb-2 flex items-center space-x-4 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <svg class="mr-2 h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                                <span class="font-medium">{{ request.destination }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="mr-2 h-4 w-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                    />
                                                </svg>
                                                <span>{{ formatDate(request.departure_date) }} até {{ formatDate(request.return_date) }}</span>
                                            </div>
                                        </div>
                                        <div v-if="request.notes" class="mt-2 flex items-start">
                                            <svg
                                                class="mr-2 mt-0.5 h-4 w-4 flex-shrink-0 text-gray-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                />
                                            </svg>
                                            <p class="rounded-lg border bg-gray-50 px-3 py-2 text-sm text-gray-600">{{ request.notes }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="ml-6 flex items-center space-x-3">
                                    <!-- Admin Actions -->
                                    <div v-if="user?.role === 'admin'" class="flex space-x-2">
                                        <!-- Quick Status Change Dropdown -->
                                        <div class="relative">
                                            <button
                                                @click="toggleStatusDropdown(request.id)"
                                                :class="[
                                                    'group relative inline-flex transform items-center rounded-lg font-medium text-white shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
                                                    user?.role === 'admin' 
                                                        ? 'bg-gradient-to-r from-blue-500 to-indigo-500 px-4 py-3 text-base hover:scale-105 hover:from-blue-600 hover:to-indigo-600' 
                                                        : 'bg-gradient-to-r from-blue-500 to-indigo-500 px-3 py-2 text-sm hover:scale-105 hover:from-blue-600 hover:to-indigo-600'
                                                ]"
                                            >
                                                <svg :class="user?.role === 'admin' ? 'mr-2 h-5 w-5' : 'mr-2 h-4 w-4'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 9l4-4 4 4m0 6l-4 4-4-4"
                                                    />
                                                </svg>
                                                <span v-if="user?.role === 'admin'">STATUS</span>
                                                <span v-else>Status</span>
                                                <svg :class="user?.role === 'admin' ? 'ml-2 h-4 w-4' : 'ml-1 h-3 w-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <div
                                                v-if="activeDropdown === request.id"
                                                class="absolute right-0 z-10 mt-2 w-48 rounded-lg border border-gray-200 bg-white shadow-lg"
                                            >
                                                <div class="py-1">
                                                    <button
                                                        v-if="request.status === 'approved' || request.status === 'cancelled'"
                                                        @click="changeStatusQuick(request.id, 'pending')"
                                                        class="flex w-full items-center px-4 py-2 text-sm text-yellow-700 transition-colors duration-200 hover:bg-yellow-50"
                                                    >
                                                        <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                            />
                                                        </svg>
                                                        Marcar como Pendente
                                                    </button>
                                                    <button
                                                        v-if="request.status !== 'approved'"
                                                        @click="changeStatusQuick(request.id, 'approved')"
                                                        class="flex w-full items-center px-4 py-2 text-sm text-green-700 transition-colors duration-200 hover:bg-green-50"
                                                    >
                                                        <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5 13l4 4L19 7"
                                                            />
                                                        </svg>
                                                        Aprovar Solicitação
                                                    </button>
                                                    <button
                                                        v-if="request.status !== 'cancelled'"
                                                        @click="changeStatusQuick(request.id, 'cancelled')"
                                                        class="flex w-full items-center px-4 py-2 text-sm text-red-700 transition-colors duration-200 hover:bg-red-50"
                                                    >
                                                        <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12"
                                                            />
                                                        </svg>
                                                        Cancelar Solicitação
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quick Action Buttons for Pending -->
                                        <div v-if="request.status === 'pending'" class="flex space-x-2">
                                            <button
                                                @click="updateStatus(request.id, 'approved')"
                                                :class="[
                                                    'group relative inline-flex transform items-center rounded-lg font-medium text-white shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2',
                                                    user?.role === 'admin' 
                                                        ? 'bg-gradient-to-r from-green-500 to-emerald-500 px-5 py-3 text-base hover:scale-105 hover:from-green-600 hover:to-emerald-600' 
                                                        : 'bg-gradient-to-r from-green-500 to-emerald-500 px-4 py-2 text-sm hover:scale-105 hover:from-green-600 hover:to-emerald-600'
                                                ]"
                                            >
                                                <svg :class="user?.role === 'admin' ? 'mr-2 h-5 w-5' : 'mr-2 h-4 w-4'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span v-if="user?.role === 'admin'">✅ APROVAR</span>
                                                <span v-else>✅ Aprovar</span>
                                            </button>
                                            <button
                                                @click="updateStatus(request.id, 'cancelled')"
                                                :class="[
                                                    'group relative inline-flex transform items-center rounded-lg font-medium text-white shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2',
                                                    user?.role === 'admin' 
                                                        ? 'bg-gradient-to-r from-red-500 to-pink-500 px-5 py-3 text-base hover:scale-105 hover:from-red-600 hover:to-pink-600' 
                                                        : 'bg-gradient-to-r from-red-500 to-pink-500 px-4 py-2 text-sm hover:scale-105 hover:from-red-600 hover:to-pink-600'
                                                ]"
                                            >
                                                <svg :class="user?.role === 'admin' ? 'mr-2 h-5 w-5' : 'mr-2 h-4 w-4'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                <span v-if="user?.role === 'admin'">❌ REPROVAR</span>
                                                <span v-else>❌ Reprovar</span>
                                            </button>
                                        </div>

                                        <!-- Enhanced Action Buttons for Non-Pending (Admin only) -->
                                        <div v-else class="flex space-x-2">
                                            <button
                                                v-if="request.status !== 'approved'"
                                                @click="updateStatus(request.id, 'approved')"
                                                class="group relative inline-flex transform items-center rounded-lg bg-gradient-to-r from-green-400 to-emerald-400 px-3 py-2 font-medium text-white shadow-md transition-all duration-200 hover:scale-105 hover:from-green-500 hover:to-emerald-500 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2"
                                            >
                                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Aprovar
                                            </button>
                                            <button
                                                v-if="request.status !== 'cancelled'"
                                                @click="updateStatus(request.id, 'cancelled')"
                                                class="group relative inline-flex transform items-center rounded-lg bg-gradient-to-r from-red-400 to-pink-400 px-3 py-2 font-medium text-white shadow-md transition-all duration-200 hover:scale-105 hover:from-red-500 hover:to-pink-500 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2"
                                            >
                                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Reprovar
                                            </button>
                                            <button
                                                v-if="request.status === 'approved' || request.status === 'cancelled'"
                                                @click="updateStatus(request.id, 'pending')"
                                                class="group relative inline-flex transform items-center rounded-lg bg-gradient-to-r from-yellow-400 to-orange-400 px-3 py-2 font-medium text-white shadow-md transition-all duration-200 hover:scale-105 hover:from-yellow-500 hover:to-orange-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                            >
                                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                    />
                                                </svg>
                                                Revisar
                                            </button>
                                        </div>
                                    </div>

                                    <!-- User Actions -->
                                    <div v-else-if="request.user_id === user?.id && request.status === 'pending'">
                                        <button
                                            @click="editRequest(request)"
                                            class="group relative inline-flex transform items-center rounded-lg border-2 border-gray-200 bg-white px-4 py-2 font-medium text-gray-700 shadow-sm transition-all duration-200 hover:scale-105 hover:border-blue-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                        >
                                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                />
                                            </svg>
                                            Editar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div v-else class="p-12 text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-r from-gray-100 to-gray-200">
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                            />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-medium text-gray-900">Nenhuma solicitação encontrada</h3>
                    <p class="text-gray-500">Tente ajustar os filtros ou criar uma nova solicitação.</p>
                </div>

                <!-- Pagination -->
                <div
                    v-if="requests.data && requests.data.length"
                    class="flex items-center justify-between border-t border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4"
                >
                    <div class="flex flex-1 justify-between sm:hidden">
                        <button
                            @click="changePage(requests.current_page - 1)"
                            :disabled="requests.current_page <= 1"
                            class="relative inline-flex transform items-center rounded-lg border-2 border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 hover:scale-105 hover:border-blue-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Anterior
                        </button>
                        <button
                            @click="changePage(requests.current_page + 1)"
                            :disabled="requests.current_page >= requests.last_page"
                            class="relative inline-flex transform items-center rounded-lg border-2 border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 hover:scale-105 hover:border-blue-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            Próxima
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                            <p class="text-sm font-medium text-gray-700">
                                Mostrando <span class="font-bold text-blue-600">{{ requests.from }}</span> até
                                <span class="font-bold text-blue-600">{{ requests.to }}</span> de
                                <span class="font-bold text-blue-600">{{ requests.total }}</span> resultados
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                @click="changePage(requests.current_page - 1)"
                                :disabled="requests.current_page <= 1"
                                class="group relative inline-flex transform items-center rounded-lg border-2 border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 hover:scale-105 hover:border-blue-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                <svg
                                    class="mr-2 h-4 w-4 transition-transform duration-200 group-hover:-translate-x-1"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                Anterior
                            </button>
                            <div class="flex items-center rounded-lg border border-blue-200 bg-blue-100 px-3 py-2 text-sm font-bold text-blue-700">
                                {{ requests.current_page }} / {{ requests.last_page }}
                            </div>
                            <button
                                @click="changePage(requests.current_page + 1)"
                                :disabled="requests.current_page >= requests.last_page"
                                class="group relative inline-flex transform items-center rounded-lg border-2 border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 hover:scale-105 hover:border-blue-300 hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-50"
                            >
                                Próxima
                                <svg
                                    class="ml-2 h-4 w-4 transition-transform duration-200 group-hover:translate-x-1"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Create/Edit Modal -->
        <TravelRequestModal :show="showCreateModal" :request="editingRequest" @close="closeModal" @saved="handleRequestSaved" />

        <!-- Cancel Modal -->
        <CancelModal :show="showCancelModal" :request="cancellingRequest" @close="closeCancelModal" @cancelled="handleRequestCancelled" />

        <!-- Status Change Modal -->
        <div v-show="showStatusModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="mx-4 w-full max-w-md rounded-lg bg-white p-8 shadow-lg">
                <h2 class="mb-4 text-xl font-bold">⚙️ Alterar Status da Solicitação</h2>
                <div class="space-y-3">
                    <p class="text-sm"><strong>Solicitação ID:</strong> {{ statusChangeRequest?.id }}</p>
                    <p class="text-sm"><strong>Requerente:</strong> {{ statusChangeRequest?.requester_name }}</p>
                    <p class="text-sm"><strong>Status Atual:</strong> {{ statusChangeRequest?.status }}</p>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button @click="closeStatusModal" class="rounded bg-gray-500 px-4 py-2 text-white transition-colors hover:bg-gray-600">
                        Cancelar
                    </button>
                    <button @click="changeStatus('pending')" class="rounded bg-yellow-500 px-4 py-2 text-white transition-colors hover:bg-yellow-600">
                        → Pendente
                    </button>
                    <button @click="changeStatus('approved')" class="rounded bg-green-500 px-4 py-2 text-white transition-colors hover:bg-green-600">
                        ✓ Aprovar
                    </button>
                    <button @click="changeStatus('cancelled')" class="rounded bg-red-500 px-4 py-2 text-white transition-colors hover:bg-red-600">
                        ✗ Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import CancelModal from '@/components/CancelModal.vue';
import TravelRequestModal from '@/components/TravelRequestModal.vue';
import { useAuthStore } from '@/composables/useAuth';
import { useToast } from '@/composables/useToast';
import { useTravelRequests } from '@/composables/useTravelRequests';
import type { PaginatedResponse, TravelRequest } from '@/types';
import { exportToCSV, formatDataForExport } from '@/utils/export';
import { debounce } from 'lodash-es';
import { computed, onMounted, reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const authStore = useAuthStore();
const travelRequestsStore = useTravelRequests();
const toast = useToast();

const user = computed(() => authStore.user.value);
const loading = ref(false);

const showCreateModal = ref(false);
const showCancelModal = ref(false);
const showStatusModal = ref(false);
const editingRequest = ref<TravelRequest | null>(null);
const cancellingRequest = ref<TravelRequest | null>(null);
const statusChangeRequest = ref<TravelRequest | null>(null);
const activeDropdown = ref<number | null>(null);

const requests = ref<PaginatedResponse<TravelRequest>>({
    data: [],
    current_page: 1,
    last_page: 1,
    from: 0,
    to: 0,
    total: 0,
    first_page_url: '',
    last_page_url: '',
    links: [],
    next_page_url: null,
    path: '',
    per_page: 15,
    prev_page_url: null,
});

const stats = reactive({
    total: 0,
    pending: 0,
    approved: 0,
    cancelled: 0,
});

const filters = reactive({
    status: '',
    destination: '',
    dateFrom: '',
    dateTo: '',
});

const loadRequests = async (page = 1) => {
    loading.value = true;
    try {
        const params = new URLSearchParams();
        if (filters.status) params.append('filter[status]', filters.status);
        if (filters.destination) params.append('filter[destination]', filters.destination);
        if (filters.dateFrom) params.append('filter[date_from]', filters.dateFrom);
        if (filters.dateTo) params.append('filter[date_to]', filters.dateTo);
        params.append('page', page.toString());

        const response = await travelRequestsStore.getRequests(params.toString());
        requests.value = response;

        // Update stats
        stats.total = response.total;
        stats.pending = response.data.filter((r: any) => r.status === 'pending').length;
        stats.approved = response.data.filter((r: any) => r.status === 'approved').length;
        stats.cancelled = response.data.filter((r: any) => r.status === 'cancelled').length;
    } catch {
        toast.error('Erro ao carregar solicitações');
    } finally {
        loading.value = false;
    }
};

const debouncedLoadRequests = debounce(() => loadRequests(), 500);

const changePage = (page: number) => {
    if (page >= 1 && page <= requests.value.last_page) {
        loadRequests(page);
    }
};

const updateStatus = async (id: number, status: string) => {
    try {
        await travelRequestsStore.updateStatus(id, { status });

        // Mensagens personalizadas baseadas no status
        const messages: { [key: string]: string } = {
            approved: '✅ Solicitação aprovada com sucesso!',
            cancelled: '❌ Solicitação reprovada com sucesso!',
            pending: '⏳ Solicitação marcada como pendente!',
        };

        toast.success(messages[status] || 'Status atualizado com sucesso!');
        await loadRequests(requests.value.current_page);
    } catch (error: any) {
        const errorMessage = error.response?.data?.message || 'Erro ao atualizar status';
        toast.error(`Erro: ${errorMessage}`);
    }
};

const closeCancelModal = () => {
    showCancelModal.value = false;
    cancellingRequest.value = null;
};

const testClick = (request: any) => {
    openStatusChangeModal(request);
};

const openStatusChangeModal = (request: any) => {
    // Verificar se é admin
    if (user.value?.role !== 'admin') {
        return;
    }

    statusChangeRequest.value = request;
    showStatusModal.value = true;
};

const closeStatusModal = () => {
    showStatusModal.value = false;
    statusChangeRequest.value = null;
};

const changeStatus = async (newStatus: string) => {
    if (!statusChangeRequest.value) {
        toast.error('Erro: Nenhuma solicitação selecionada');
        return;
    }

    try {
        await travelRequestsStore.updateStatus(statusChangeRequest.value.id, {
            status: newStatus,
            cancellation_reason: newStatus === 'cancelled' ? 'Cancelado via modal de status' : null,
        });

        toast.success(`Status alterado para "${getStatusLabel(newStatus)}" com sucesso!`);
        closeStatusModal();

        await loadRequests(requests.value.current_page);
    } catch (error: any) {
        const errorMessage = error.response?.data?.message || error.message || 'Erro ao alterar status';
        toast.error(`Erro: ${errorMessage}`);
    }
};

const toggleStatusDropdown = (requestId: number) => {
    activeDropdown.value = activeDropdown.value === requestId ? null : requestId;
};

const changeStatusQuick = async (requestId: number, newStatus: string) => {
    try {
        await travelRequestsStore.updateStatus(requestId, { status: newStatus });
        toast.success(`Status alterado para "${getStatusLabel(newStatus)}" com sucesso!`);
        activeDropdown.value = null; // Fechar dropdown
        await loadRequests(requests.value.current_page);
    } catch {
        toast.error('Erro ao alterar status');
    }
};

const showStatusChangeNotification = (request: any) => {
    if (user.value?.role !== 'admin') return;

    const onStatusChange = async (status: string) => {
        try {
            await travelRequestsStore.updateStatus(request.id, { status });
            toast.success(`Status alterado para "${getStatusLabel(status)}" com sucesso!`);
            await loadRequests(requests.value.current_page);
        } catch {
            toast.error('Erro ao alterar status');
        }
    };

    toast.statusChangeNotification(request.id, request.requester_name, onStatusChange);
};

const notifyPendingRequests = () => {
    if (user.value?.role !== 'admin') return;

    const pendingRequests = requests.value.data.filter((r) => r.status === 'pending');

    if (pendingRequests.length > 0) {
        const firstPending = pendingRequests[0];
        showStatusChangeNotification(firstPending);
    }
};

const clearFilters = () => {
    filters.status = '';
    filters.destination = '';
    filters.dateFrom = '';
    filters.dateTo = '';
    loadRequests();
};

const exportRequests = () => {
    if (!requests.value.data || requests.value.data.length === 0) {
        toast.warning('Nenhum dado para exportar');
        return;
    }

    try {
        const formattedData = formatDataForExport(requests.value.data);
        const filename = `solicitacoes-viagem-${new Date().toISOString().split('T')[0]}.csv`;
        exportToCSV(formattedData, filename);
        toast.success('Arquivo CSV exportado com sucesso!');
    } catch {
        toast.error('Erro ao exportar arquivo CSV');
    }
};

const editRequest = (request: any) => {
    editingRequest.value = request;
    showCreateModal.value = true;
};

const closeModal = () => {
    showCreateModal.value = false;
    editingRequest.value = null;
};

const handleRequestSaved = () => {
    closeModal();
    toast.success('Solicitação salva com sucesso!');
    loadRequests(requests.value.current_page);
};

const handleRequestCancelled = () => {
    closeCancelModal();
    toast.success('Solicitação cancelada com sucesso!');
    loadRequests(requests.value.current_page);
};

const handleLogout = async () => {
    try {
        await authStore.logout();
        router.push('/login');
    } catch {
        toast.error('Erro ao fazer logout');
    }
};

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('pt-BR');
};

const getStatusLabel = (status: string) => {
    const labels: Record<string, string> = {
        pending: 'Pendente',
        approved: 'Aprovado',
        cancelled: 'Cancelado',
    };
    return labels[status] || status;
};

onMounted(async () => {
    if (!authStore.isAuthenticated) {
        router.push('/login');
        return;
    }

    // Force refresh user data to ensure we have the latest info
    try {
        await authStore.me();
    } catch {
        // Silently handle error - user data will be refreshed from localStorage
    }

    loadRequests();

    // Fechar dropdown quando clicar fora
    document.addEventListener('click', (event) => {
        const target = event.target as HTMLElement;
        if (!target.closest('.relative')) {
            activeDropdown.value = null;
        }
    });
});
</script>

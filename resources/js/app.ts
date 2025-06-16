import { createApp } from 'vue';
import type { RouteRecordRaw } from 'vue-router';
import { createRouter, createWebHistory } from 'vue-router';
import '../css/app.css';
import App from './App.vue';
import Dashboard from './pages/Dashboard.vue';
import Login from './pages/Login.vue';
import Profile from './pages/Profile.vue';
import Register from './pages/Register.vue';

const routes: RouteRecordRaw[] = [
    { path: '/', redirect: '/dashboard' },
    { path: '/login', component: Login, name: 'login' },
    { path: '/register', component: Register, name: 'register' },
    { path: '/dashboard', component: Dashboard, name: 'dashboard', meta: { requiresAuth: true } },
    { path: '/profile', component: Profile, name: 'profile', meta: { requiresAuth: true } },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Navigation guard for authentication
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('auth_token');

    if (to.meta.requiresAuth && !token) {
        next('/login');
    } else if ((to.path === '/login' || to.path === '/register') && token) {
        next('/dashboard');
    } else {
        next();
    }
});

const app = createApp(App);
app.use(router);
app.mount('#app');

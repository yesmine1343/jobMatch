// This router config for SPA routes and Laravel's monolithic SPA setup.

import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/home.vue';
import Login from '../views/auth/Login.vue';
import ForgotPassword from '../views/auth/ForgotPassword.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/login',            // user sees /login
        name: 'login',             // for navigation and redirection in code ex:router.push({name:'ForgotPassword'})
        component: Login,           // what Vue renders
    },
    {
        path:'/forgot-password',
        name:'ForgotPassword',
        component: ForgotPassword,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
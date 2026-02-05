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
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path:'/forgot-password',
        name:'ForgotPassword',
        component: ForgotPassword,
    }
];

const router = createRouter({
    history: createWebHistory('/app/'),
    routes,
});

router.beforeEach(async (to, from, next) => {
    console.log(`Navigating to: ${to.name}`);
    next();
});


export default router;

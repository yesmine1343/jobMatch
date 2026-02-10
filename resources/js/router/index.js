import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/home.vue';
import Login from '../views/auth/Login.vue';
import Register from '../views/auth/Register.vue';
import ForgotPassword from '../views/auth/ForgotPassword.vue'
import UserIdentityVerification from '../views/auth/userIdentityVerification.vue'

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
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/forgot-password',
        name: 'ForgotPassword',
        component: ForgotPassword,
    },
    {
        path: '/user-identity-verification',
        name: 'UserIdentityVerification',
        component: UserIdentityVerification,
    }
];

const router = createRouter({
    history: createWebHistory('/app/'),         //= My app lives under /app
    routes,
});
/* 
ADDITION UP IN ROUTER VARIABLE NECESSARY AFTER CHANGES LIKE ->  

Route::get('/app/{any?}', function () {
    return view('app');
})->where('any', '.*');

*/

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    const authPages = ['login', 'register', 'ForgotPassword'];
    const isAuthPage = authPages.includes(to.name);

    // If user has token and tries to access login/register, ask if they want to switch accounts
    if (token && isAuthPage) {
        let message = 'You are already logged in. Do you want to log in with another account?';

        if (to.name === 'register') {
            message = 'You are currently logged in. Do you want to log out and create a new account?';
        } else if (to.name === 'login') {
            message = 'You are currently logged in. Do you want to log out and switch accounts?';
        }

        const wantToSwitch = confirm(message);

        if (wantToSwitch) {
            // Clear current token and proceed to auth page
            localStorage.removeItem('token');
            return next();
        } else {
            // Stay logged in, redirect to home
            return next({ name: 'home' });
        }
    }

    // If user doesn't have token and tries to access protected page, redirect to login
    if (!token && !isAuthPage) {
        return next({ name: 'login' });
    }

    next();
});

/* 
beforeEach is a navigation guard. Right now it only logs.execute code before a user is redirected.
 It acts as a middleware that triggers on every navigation attempt,
 allowing you to validate, cancel, or redirect the user before the new route is confirmed. 
Later it will: block unauthenticated users ,redirect logged-in users ,enforce roles ,protect pages
*/
//https://router.vuejs.org/guide/advanced/navigation-guards.html

export default router;
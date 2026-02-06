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
    history: createWebHistory('/app/'),         //= My app lives under /app
    routes,
});
/* 
ADDITION UP IN ROUTER VARIABLE NECESSARY AFTER CHANGES LIKE ->  

Route::get('/app/{any?}', function () {
    return view('app');
})->where('any', '.*');

*/

router.beforeEach(async (to, from, next) => {
    console.log(`Navigating to: ${to.name}`);
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
import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/home.vue';
import Login from '../views/auth/Login.vue';
import Register from '../views/auth/Register.vue';
import ForgotPassword from '../views/auth/ForgotPassword.vue';
import UserIdentityVerification from '../views/auth/userIdentityVerification.vue';
import ResetPassword from '../views/auth/ResetPassword.vue';
import RoleSelection from '../views/Role/role-selection.vue';
import CandidateProfileSetup from '../views/candidate/profile-setup.vue';
import RecruiterProfileSetup from '../views/recruiter/profile-setup.vue';
import DashboardPreview from '../views/Role/DashboardPreview.vue';
import CandidateDashboard from '../views/candidate/dashboard.vue';
import RecruiterDashboard from '../views/recruiter/dashboard.vue';
import CreateJob from '../views/recruiter/create-job.vue';


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
    },
    {
        path: '/reset-password',
        name: 'ResetPassword',
        component: ResetPassword,
    },
    {
        path: '/Role/role-selection',
        name: 'RoleSelection',
        component: RoleSelection,
    },
    {
        path: '/candidate/profile-setup',
        name: 'candidateProfileSetup',
        component: CandidateProfileSetup,
    },
    {
        path: '/recruiter/profile-setup',
        name: 'recruiterProfileSetup',
        component: RecruiterProfileSetup,
    },
    {
        path: '/Role/DashboardPreview',
        name: 'DashboardPreview',
        component: DashboardPreview,
    },
    {
        path: '/candidate/dashboard',
        name: 'Cdashboard',
        component: CandidateDashboard,
    },
    {
        path: '/recruiter/dashboard',
        name: 'Rdashboard',
        component: RecruiterDashboard,
    },
    {
        path: '/recruiter/create-job',
        name: 'CreateJob',
        component: 'CreateJob',
    },
    {
        path: '/recruiter/match-score',
        name: 'MatchScore',
        component: 'MatchScore',
    }
];

const router = createRouter({
    history: createWebHistory('/app/'),         //= My app lives under /app
    routes,
});
/*
How it works: Every time a user clicks a link or changes the URL, the router.beforeEach function runs before the page actually loads.
We have a list called authPages. If the route the user is trying to visit is NOT in that list 
(like a dashboard or profile setup) and they don't have a token, the guard stops them and redirects them to /login.
*/

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    const authPages = ['login', 'register', 'ForgotPassword', 'ResetPassword', 'UserIdentityVerification'];
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


export default router;
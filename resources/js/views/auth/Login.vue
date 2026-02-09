<template>
  <div class="min-h-screen flex items-center justify-start pl-24">
    <form @submit.prevent="handleSubmit" novalidate ref="formEl" class="bg-indigo-300 w-1/3 rounded-xl shadow-2xl border-2 border-slate-200 max-w-md p-8 space-y-5">
      <div class="space-y-2">
        <label for="username" class="block text-sm font-semibold text-slate-700">Username:</label>
        <input type="text" v-model.lazy.trim="form.username" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
      </div>

      <!-- Email -->
      <div class="space-y-2">
        <label for="email" class="block text-sm font-semibold text-slate-700">Email address:</label>
        <input type="email" v-model.lazy.trim="form.email" placeholder="you@example.com" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
      </div>

      <!-- Password -->
      <div class="space-y-2">
        <label for="pwd" class="block text-sm font-semibold text-slate-700">Password:</label>
        <input type="password" id="pwd" v-model.lazy="form.password" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
        
        <!-- Error messages -->
        <p v-if="errorType === 'invalid_credentials'" class="mt-1 text-xs text-indigo-900">
          Invalid credentials
        </p>
        <p v-if="errorType === 'account_not_found'" class="mt-1 text-xs text-indigo-900">
          This account does not exist, do you want to 
          <a href="" @click.prevent="$router.push({ name: 'register' })" class="text-blue-600 hover:underline">sign up?</a>
        </p>
      </div>

      <!-- Remember me -->
      <div class="flex items-center gap-3 py-2">
        <input type="checkbox" id="remember" v-model="form.remember" class="w-4 h-4 rounded border-2 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-200">
        <label for="remember" class="text-sm text-slate-600 cursor-pointer">Remember me</label>
        
      </div>

      <!-- Submit -->
      <button type="submit" class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 px-4 py-3 text-base font-semibold text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-md">
        Submit
      </button>

      <!-- Forgot password -->
      <div class="text-center mt-4">
        <a href="" @click.prevent="$router.push({ name: 'ForgotPassword' })" class="text-sm text-blue-600 hover:text-blue-800 hover:underline font-medium">
          Forgot password?
        </a>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';


const router = useRouter();

const form = ref({
  username: '',
  password: '',
  email: '',
  remember: false,
});

const errorType = ref('');

// handler sends a POST request to the login/auth HTTP endpoint.
const handleSubmit = async () => {
  // Clear previous error
  errorType.value = '';
  
  try {
    // Send a POST request to your Laravel API endpoint
    const response = await axiosInstance.post('/api/auth/login', form.value);
    
    // Store the authentication token
    if (response.data.token) {
      localStorage.setItem('token', response.data.token);
    }
    
    // Redirect to home
    router.push({ name: 'home' });
    
  } catch (error) {
    console.error('Login error:', error.response?.data || error.message);
    
    // Set error type based on backend response
    if (error.response?.data?.error_type) {
      errorType.value = error.response.data.error_type;
    }
  }
};

const handleCancel = () => {
  router.push({ name: 'home' });
};
</script>


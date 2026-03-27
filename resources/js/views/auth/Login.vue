<template>
  <div class="min-h-screen flex items-center justify-center relative">
    <div
      v-if="errorType"
      role="status"
      class="fixed top-4 left-1/2 z-50 -translate-x-1/2 rounded-lg border border-blue-200 bg-blue-50 px-4 py-2 text-center text-sm text-blue-700 shadow-sm"
    >
      <template v-if="errorType === 'account_not_found'">
        This account does not exist.
        <a href="#" @click.prevent="$router.push({ name: 'register' })" class="ml-1 font-medium underline">Sign up?</a>
      </template>
      <template v-else-if="errorType === 'invalid_credentials'">
        Invalid credentials.
      </template>
    </div>
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
      </div>

      <!-- Remember me -->
      <div class="flex items-center gap-3 py-2">
        <input type="checkbox" id="remember" v-model="form.remember" class="w-4 h-4 rounded border-2 border-slate-300 text-blue-600 focus:ring-2 focus:ring-blue-200">
        <label for="remember" class="text-sm text-slate-600 cursor-pointer">Remember me</label>
        
      </div>

      <!-- Submit -->
      <button 
        type="submit" 
        :disabled="isLoading"
        class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed px-4 py-3 text-base font-semibold text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-md"
      >
        {{ isLoading ? 'Logging in...' : 'Submit' }}
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
const isLoading = ref(false);

// handler sends a POST request to the login/auth HTTP endpoint.
const handleSubmit = async () => {
  // Prevent multiple submissions
  if (isLoading.value) return;
  
  // Clear previous error
  errorType.value = '';
  isLoading.value = true;
  
  try {
    // Send a POST request to your Laravel API endpoint
    const response = await axiosInstance.post('/api/auth/login', form.value);
    
    // Store the authentication token
    if (response.data.token) {
      console.log('FULL RESPONSE:', response.data);
      localStorage.setItem('token', response.data.token);
      localStorage.setItem('user', JSON.stringify(response.data.user));
    }
    
    // Redirect to home
    router.push({ name: 'home' });
    
  } catch (error) {
    console.error('Login error:', error.response?.data || error.message);
    
    // Set error type based on backend response
    if (error.response?.data?.error_type) {
      errorType.value = error.response.data.error_type;
    }
  // Auto-clear error after 3 seconds
    setTimeout(() => {
      errorType.value = '';
    }, 3000);
  } finally {
    isLoading.value = false;
  }
};

const handleCancel = () => {
  router.push({ name: 'home' });
};
</script>


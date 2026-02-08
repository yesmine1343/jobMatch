<template>
  <div class="min-h-screen flex items-center justify-start pl-24">
    <form @submit.prevent="handleSubmit" novalidate ref="form" class="bg-indigo-300 w-1/3 rounded-xl shadow-2xl border-2 border-slate-200 max-w-md p-8 space-y-5">
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

const router = useRouter();

const form = ref({
  username: '',
  password: '',
  email: '',
  remember: false,
});

// handler sends a POST request to the login/auth HTTP endpoint.
const handleSubmit = async () => {
  try {
    // Send a POST request to your Laravel API endpoint
    const response = await window.axios.post('/api/auth/login', form.value);
    
    console.log('Login successful:', response.data);
    // TODO: Handle successful login (e.g., store token, redirect)
    
  } catch (error) {
    console.error('Login error:', error.response?.data || error.message);
    // TODO: Display error message to user
  }
};

const handleCancel = () => {
  router.push({ name: 'home' });
};
</script>

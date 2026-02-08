<template>
  <div class="min-h-screen flex items-center justify-start pl-24">
    <form @submit.prevent="handleSubmit" novalidate ref="formElement" autocomplete="off" class="bg-indigo-300 w-1/3 rounded-xl shadow-2xl border-2 border-slate-200 max-w-md p-8 space-y-5">
      <div class="space-y-2">
        <label for="name" class="block text-sm font-semibold text-slate-700">Name:</label>
        <input id="name" name="name" type="text" autocomplete="off" required v-model.trim="form.name" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
      </div>

      <!-- Email -->
      <div class="space-y-2">
        <label for="email" class="block text-sm font-semibold text-slate-700">Email address:</label>
        <input id="email" name="email" type="email" autocomplete="off" required placeholder="you@example.com" v-model.trim="form.email" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
      </div>

      <!-- Password -->
      <div class="space-y-2">
        <label for="password" class="block text-sm font-semibold text-slate-700">Password:</label>
        <input id="password" name="password" type="password" autocomplete="new-password" required v-model="form.password" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
      </div>

      <!-- Confirm Password -->
      <div class="space-y-2">
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirm password:</label>
        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required v-model="form.password_confirmation" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
      </div>

      <!-- Submit -->
      <button type="submit" class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 px-4 py-3 text-base font-semibold text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-md">
        Register
      </button>

      <!-- Login link -->
      <div class="text-center mt-4">
        <a href="" @click.prevent="$router.push({ name: 'login' })" class="text-sm text-blue-600 hover:text-blue-800 hover:underline font-medium">
          Already have an account? Login
        </a>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

// Reset form to ensure clean state on component mount
onMounted(() => {
  form.value = {
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  };
});

const handleSubmit = async () => {
  try {
    // Send a POST request to your Laravel API endpoint
    const response = await window.axios.post('/api/auth/register', form.value);
    
    console.log('Registration successful:', response.data);
    // TODO: Handle successful registration (e.g., redirect to login)
    
  } catch (error) {
    console.error('Registration error:', error.response?.data || error.message);
    // TODO: Display error message to user
  }
};
</script>

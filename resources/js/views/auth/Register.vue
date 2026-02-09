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

      <div class="space-y-2">
        <label for="password" class="block text-sm font-semibold text-slate-700">Password:</label>
        <input id="password" name="password" type="password" autocomplete="new-password" required v-model="form.password" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
        <p v-if="form.password && missingRequirements.length > 0" class="mt-1 text-xs text-indigo-900">
          please change your password to fit our security requirements
        </p>
      </div>
      <div class="space-y-2">
        <p class="text-sm text-slate-700 mt-2 leading-relaxed">
          Your password must:
        </p>
      <ul class="text-sm text-slate-700 ml-4 space-y-1">
        <li>
          • At least 8 characters
          <span v-if="passwordRules.minLength" class="text-green-600">✓</span>
        </li>
        <li>
          • Contain one uppercase letter
          <span v-if="passwordRules.hasUpper" class="text-green-600">✓</span>
        </li>
        <li>
          • Contain one number
          <span v-if="passwordRules.hasNumber" class="text-green-600">✓</span>
        </li>
        <li>
          • Contain one special character
          <span v-if="passwordRules.hasSymbol" class="text-green-600">✓</span>
        </li>
      </ul>
      </div>

      <!-- Confirm Password -->
      <div class="space-y-2">
        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirm password:</label>
        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required v-model="form.password_confirmation" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
       
        <p v-if="form.password_confirmation && !passwordsMatch" class="mt-1 text-xs text-indigo-900">
          Passwords do not match
        </p>
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
import { ref, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';

const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const passwordRules = computed(() => {
  const p = form.value.password

  return {
    minLength: p.length >= 8,
    hasUpper: /[A-Z]/.test(p),
    hasNumber: /\d/.test(p),
    hasSymbol: /[^A-Za-z0-9]/.test(p),
  }
})

const missingRequirements = computed(() => {
  const missing = []
  const rules = passwordRules.value

  if (!rules.minLength) missing.push('Password must be at least 8 characters')
  if (!rules.hasUpper) missing.push('Password must contain one uppercase letter')
  if (!rules.hasNumber) missing.push('Password must contain one number')
  if (!rules.hasSymbol) missing.push('Password must contain one special character')

  return missing
})

const passwordsMatch = computed(() => {
  return form.value.password === form.value.password_confirmation
})

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
    const response = await axiosInstance.post('/api/auth/register', form.value);
    
    console.log('Full response:', response.data);
    console.log('Token received:', response.data.token);
    
    // Store the authentication token (if returned)
    if (response.data.token) {
      localStorage.setItem('token', response.data.token);
      console.log('Token stored:', localStorage.getItem('token'));
    } else {
      console.warn('No token in response!');
    }
    
    // Show success message from backend
    alert(response.data.message);
    
    // Redirect to home
    router.push({ name: 'home' });
    
  } catch (error) {
    console.error('Registration error:', error.response?.data || error.message);
    // Display validation errors from backend
    if (error.response?.data?.message) {
      alert(error.response.data.message);
    }
  }
};
</script>

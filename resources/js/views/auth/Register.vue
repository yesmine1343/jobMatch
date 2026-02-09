<template>
  <div class="min-h-screen flex items-center justify-start pl-24">
    <form @submit.prevent="handleSubmit" novalidate ref="formElement" autocomplete="off" class="bg-indigo-300 w-1/3 rounded-xl shadow-2xl border-2 border-slate-200 max-w-md p-8 space-y-5">
      <div class="space-y-2">
        <label for="username" class="block text-sm font-semibold text-slate-700">Username:</label>
        <input id="username" name="username" type="text" autocomplete="off" required v-model.trim="form.username" class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 bg-slate-50 text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200">
        <!-- Username availability status -->
        <p v-if="form.username && usernameStatus === 'taken'" class="mt-1 text-xs text-indigo-900">
          Username is already taken
        </p>
        <p v-if="form.username && usernameStatus === 'available'" class="mt-1 text-xs text-indigo-900">
          Username is available
        </p>
        <p v-if="form.username && usernameStatus === 'checking'" class="mt-1 text-xs text-indigo-900">
          Checking...
        </p>
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
          Your password must have:
        </p>
      <ul class="text-sm text-slate-700 ml-4 space-y-1">
        <li>
          • At least 8 characters
          <span v-if="passwordRules.minLength" class="text-green-600">✓</span>
        </li>
        <li>
          • one uppercase letter
          <span v-if="passwordRules.hasUpper" class="text-green-600">✓</span>
        </li>
        <li>
          • one number
          <span v-if="passwordRules.hasNumber" class="text-green-600">✓</span>
        </li>
        <li>
          • one special character
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
        <p v-if="hasEmptyFields && showEmptyFieldsMessage" class="mt-1 text-xs font-bold text-black">
          You're almost there, please fill out the rest of the form
        </p>
        <p v-if="backendError" class="mt-1 text-xs font-bold text-green-600">
          {{ backendError }}
        </p>
      </div>

      <!-- Submit -->
      <button type="submit" class="w-full rounded-lg bg-blue-600 hover:opacity-90 px-4 py-3 text-base font-semibold text-white transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-md">
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
import { ref, onMounted, computed, watch } from 'vue';
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';

const router = useRouter();

const form = ref({
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const usernameStatus = ref(''); // 'checking', 'available', 'taken', ''
const showEmptyFieldsMessage = ref(false);
const backendError = ref('');

// Debounce timer
let debounceTimer = null;

// Watch username for changes and check availability
watch(() => form.value.username, (newUsername) => {
  if (debounceTimer) clearTimeout(debounceTimer);
  
  if (!newUsername || newUsername.length < 2) {
    usernameStatus.value = '';
    return;
  }
  
  usernameStatus.value = 'checking';
  
  debounceTimer = setTimeout(async () => {
    try {
      const response = await axiosInstance.post('/api/auth/check-username', { username: newUsername });
      usernameStatus.value = response.data.available ? 'available' : 'taken';
    } catch (error) {
      console.error('Username check error:', error);
      usernameStatus.value = '';
    }
  }, 500); // 500ms debounce
});

// Watch email for changes to clear backend errors
watch(() => form.value.email, () => {
  backendError.value = ''; 
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

const hasEmptyFields = computed(() => {
  return !form.value.username || 
         !form.value.email || 
         !form.value.password || 
         !form.value.password_confirmation;
})

// Reset form to ensure clean state on component mount
onMounted(() => {
  form.value = {
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
  };
});

const handleSubmit = async () => {
  backendError.value = ''; // Clear previous error

  // Check for empty fields first
  if (hasEmptyFields.value) {
    showEmptyFieldsMessage.value = true;
    return;
  }
  
  // Hide message if fields are filled
  showEmptyFieldsMessage.value = false;

  // Prevent submission if username is not available
  if (usernameStatus.value !== 'available') {
    alert('Please choose an available username');
    return;
  }

  try {
    // Send a POST request to your Laravel API endpoint
    const response = await axiosInstance.post('/api/auth/register', form.value);
    
    // Store the authentication token (if returned)
    if (response.data.token) {
      localStorage.setItem('token', response.data.token);
    }
    
    // Show success message from backend
    alert(response.data.message);
    
    // Redirect to home
    router.push({ name: 'home' });
    
  } catch (error) {
    console.error('Registration error:', error.response?.data || error.message);
    
    // Handle validation errors from backend
    if (error.response?.data?.message) {
      backendError.value = error.response.data.message;
    } else {
       backendError.value = 'An error occurred during registration.';
    }
  }
};
</script>


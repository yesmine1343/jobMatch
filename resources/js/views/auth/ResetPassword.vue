<template>
  <div class="min-h-screen mt-1 flex flex-col items-start pl-24 pt-12">
    <!-- Success Banner -->
    <Transition name="fade">
      <div v-if="successMessage" 
           class="mb-8 flex items-center bg-[#3b82f6] text-white p-5 rounded-2xl shadow-lg border border-blue-400 w-full max-w-2xl">
        <div class="flex-shrink-0 bg-white rounded-full w-14 h-14 flex items-center justify-center mr-5 shadow-inner">
          <svg class="w-8 h-8 text-[#3b82f6]" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <p class="text-xl font-medium leading-tight text-white">
          {{ successMessage }}
        </p>
      </div>
    </Transition>

    <div v-if="!successMessage" class="bg-indigo-300 w-1/3 rounded-xl shadow-2xl border-2 border-slate-200 max-w-md p-8 space-y-5">
      <h2 class="text-2xl font-bold text-slate-800 mb-2">Create New Password</h2>
      <p class="text-slate-600 text-sm mb-4">Please enter your new password below to regain access to your account.</p>

      <form @submit.prevent="handleReset" novalidate class="space-y-4">
        <div>
          <label for="password" class="block text-sm font-semibold text-slate-700">New Password</label>
          <input id="password" v-model="form.password" type="password" required class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
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

        <div>
          <label for="password_confirmation" class="block text-sm font-semibold text-slate-700">Confirm Password</label>
          <input id="password_confirmation" v-model="form.password_confirmation" type="password" required class="w-full px-4 py-3 rounded-lg border-2 border-slate-300 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
          <p v-if="form.password_confirmation && !passwordsMatch" class="mt-1 text-xs text-indigo-900">
            Passwords do not match
          </p>
        </div>

        <p v-if="error" class="text-red-600 text-xs font-bold">{{ error }}</p>
        <p v-if="hasEmptyFields && showEmptyFieldsMessage" class="mt-1 text-xs font-bold text-black">
          Please fill out both password fields
        </p>

        <button type="submit" :disabled="loading" class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 px-4 py-3 text-white font-bold transition-all shadow-md disabled:opacity-50">
          {{ loading ? 'Updating...' : 'Update Password' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';

const route = useRoute();
const router = useRouter();

const loading = ref(false);
const error = ref('');
const successMessage = ref('');
const showEmptyFieldsMessage = ref(false);

const form = ref({
  token: '',
  email: '',
  password: '',
  password_confirmation: '',
});

onMounted(() => {
  form.value.token = route.query.token || '';
  form.value.email = route.query.email || '';
  
  if (!form.value.token || !form.value.email) {
    error.value = 'Invalid or expired password reset link.';
  }
});

const passwordRules = computed(() => {
  const p = form.value.password;
  return {
    minLength: p.length >= 8,
    hasUpper: /[A-Z]/.test(p),
    hasNumber: /\d/.test(p),
    hasSymbol: /[^A-Za-z0-9]/.test(p),
  };
});

const missingRequirements = computed(() => {
  const missing = [];
  const rules = passwordRules.value;

  if (!rules.minLength) missing.push('Password must be at least 8 characters');
  if (!rules.hasUpper) missing.push('Password must contain one uppercase letter');
  if (!rules.hasNumber) missing.push('Password must contain one number');
  if (!rules.hasSymbol) missing.push('Password must contain one special character');

  return missing;
});

const passwordsMatch = computed(() => {
  return form.value.password === form.value.password_confirmation;
});

const hasEmptyFields = computed(() => {
  return !form.value.password || !form.value.password_confirmation;
});

const handleReset = async () => {
    error.value = '';
    
    if (hasEmptyFields.value) {
      showEmptyFieldsMessage.value = true;
      return;
    }
    showEmptyFieldsMessage.value = false;

    if (missingRequirements.value.length > 0) {
      error.value = 'Please meet all password requirements before submitting.';
      return;
    }

    if (!passwordsMatch.value) {
      error.value = 'Passwords do not match.';
      return;
    }

    loading.value = true;

    try {
        const response = await axiosInstance.post('/api/auth/reset-password', form.value);
        successMessage.value = 'Password updated successfully! You can now login with your new password.';
        
        // Redirect to login after 3 seconds
        setTimeout(() => {
            router.push({ name: 'login' });
        }, 3000);
    } catch (err) {
        error.value = err.response?.data?.message || 'An error occurred. Please check your password meets requirements.';
    } finally {
        loading.value = false;
    }
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 2s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>

<template>
  <div class="min-h-screen mt-1 flex flex-col items-start pl-24 pt-12">
    <!-- Form -->
    <form @submit.prevent="handleSubmit" novalidate class="bg-indigo-300 w-1/3 rounded-xl shadow-2xl border-2 border-slate-200 max-w-md p-8 space-y-5">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
        <input type="email" id="email" v-model="form.email" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
      </div>

      <div>
        <button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          Reset Password
        </button>
      </div>
    </form>

    <!-- Success Banner -->
    <Transition name="fade">
      <div v-if="successMessage" 
           class="mt-8 flex items-center bg-[#3b82f6] text-white p-5 rounded-2xl shadow-lg border border-blue-400 w-full max-w-2xl">
        <div class="flex-shrink-0 bg-white rounded-full w-14 h-14 flex items-center justify-center mr-5 shadow-inner">
          <svg class="w-8 h-8 text-[#3b82f6]" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <p class="text-xl font-medium leading-tight">
          {{ successMessage }}
        </p>
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';

const router = useRouter();
const successMessage = ref('');

const form = ref({
  email: '',
});

const handleSubmit = async () => {
  try {
    const response = await axiosInstance.post('/api/auth/forgot-password', form.value);
    
    successMessage.value = 'If an account exists with this email, you’ll receive a password reset link shortly. Please check your inbox';
    console.log('Password reset email sent:', response.data);    

    setTimeout(() => {
      successMessage.value = '';
    }, 3000);

  } catch (error) {
    console.error('Error:', error.response?.data || error.message);
  }
};

const handleCancel = () => {
  router.push({ name: 'register' });
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

.login-container {
  justify-content: left;
  align-items: center;
  min-height: 60vh;
  padding: 2rem;
  max-width: 400px;
  margin-left: 12%;
  margin-top: 4%;
}
</style>

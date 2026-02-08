<template>
  <div class="min-h-screen mt-1 flex justify-start pl-24">
    <form @submit.prevent="handleSubmit" novalidate class="mt-12 h-1/5 bg-indigo-300 w-1/3 rounded-xl shadow-2xl border-2 border-slate-200 max-w-md p-8 space-y-5">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
        <input type="email" id="email" v-model="form.email" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
      </div>

      <div>
        <button type="submit" class="w-full rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          Next
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const form = ref({
  email: '',
});

const handleSubmit = async () => {
  try {
    // Send a POST request to your Laravel API endpoint
    const response = await window.axios.post('/api/auth/forgot-password', form.value);
    
    console.log('Password reset email sent:', response.data);
    // TODO: Display success message to user
    
  } catch (error) {
    console.error('Error:', error.response?.data || error.message);
    // TODO: Display error message to user
  }
};

const handleCancel = () => {
  router.push({ name: 'home' });
};
</script>

<style scoped>
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

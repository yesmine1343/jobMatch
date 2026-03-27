<template>
  <div class="flex min-h-screen bg-gradient-to-br from-slate-900 to-slate-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#0f172a] flex flex-col p-6 gap-6 min-h-screen">
      <div class="flex flex-col items-center gap-3 pt-4">
        <div class="w-20 h-20 rounded-full bg-slate-700 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-slate-400" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
          </svg>
        </div>
        <p class="text-white font-semibold text-lg">Candidate</p>
      </div>

      <hr class="border-slate-700" />

      <nav class="space-y-3">
        <router-link
          :to="{ name: 'JobList' }"
          class="block w-full rounded-xl bg-blue-600 px-6 py-4 text-white text-lg font-semibold hover:bg-blue-700 transition"
        >
          Browse Jobs →
        </router-link>
  
        <router-link
          :to="{ name: 'RoleSelection' }"
          class="block w-full rounded-xl bg-slate-800/70 border border-slate-700 px-6 py-4 text-blue-200 text-lg font-semibold hover:bg-slate-700 transition"
        >
          Switch to Recruiter →
        </router-link>

        <!-- More Options Container -->
        <div>
          <button
            @click="showMoreOptions = !showMoreOptions"
            class="block w-full rounded-xl bg-slate-800/70 px-6 py-4 text-slate-300 text-sm font-semibold hover:bg-slate-700 transition text-left 
            flex justify-between items-center">
            More Options
            <span class="text-xs">{{ showMoreOptions ? '▼' : '▶' }}</span>
          </button>

          <!-- Delete button only shows when showMoreOptions is true -->
          <div v-if="showMoreOptions" class="mt-3 bg-slate-900 p-4 rounded-xl border border-slate-700">
            <p class="text-xs text-red-400 mb-3 leading-relaxed">
              WARNING: this action is permanent once your account is removed it will be gone forever!
            </p>
            <button
              @click="handleDelete"
              class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition">
              Delete Account
            </button>
          </div>
          </div>
      </nav>
    </aside>

  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import axiosInstance from '../api/axios';
import { ref } from 'vue';
const router = useRouter();
const showMoreOptions = ref(false);  // Controls if dropdown is open or closed

const handleDelete = async () => {
  // Ask user to confirm
  if (confirm('Are you absolutely sure? This cannot be undone.')) {
    try {
      // Send DELETE request to backend
      await axiosInstance.delete('/api/candidate/delete');
      localStorage.removeItem('token');
      localStorage.removeItem('user');

      router.push({ name: 'login' });
      
    } catch (error) {
      alert('Error deleting account: ' + error.response?.data?.message);
    }
  }
};
</script>
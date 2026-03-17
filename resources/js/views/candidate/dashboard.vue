<template>
  <div class="flex min-h-screen bg-gradient-to-br from-slate-900 to-slate-800">

    <CandidateSidebar />

    <div class="flex-1 p-6">
      <div class="max-w-6xl mx-auto">
        <div class="text-center mt-6 mb-10">
          <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white">
            Candidate Dashboard
          </h1>
          <p class="mt-3 text-lg md:text-xl text-blue-300 font-medium">
            Find your best job matches
          </p>
        </div>

        <div class="grid grid-cols-3 gap-8 mt-10">
          <div class="col-span-2 bg-[#1e293b] p-6 rounded-xl">
            <h2 class="text-xl font-semibold mb-4 text-white">Recent Jobs</h2>
          </div>

          <div class="bg-[#1e293b] p-6 rounded-xl flex flex-col gap-4">
            <h2 class="text-xl font-semibold mb-4 text-white">Quick Stats</h2>
            <div class="space-y-4 mb-4">
              <div class="bg-slate-800 p-4 rounded-lg">
                <p class="text-slate-400 text-sm">Total Jobs</p>
                <p class="text-2xl font-bold text-white">{{ jobs.length }}</p>
              </div>
            </div>
            <button @click="router.push({ name: 'JobList' })" 
              class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
              See All Job Offers
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';
import CandidateSidebar from '../../components/CandidateSidebar.vue';

const router = useRouter();
const jobs = ref([]);

axiosInstance.get('/api/candidate/jobs/index')
  .then(response => { jobs.value = response.data; })
  .catch(error => { console.error('Error fetching jobs:', error); });
</script>
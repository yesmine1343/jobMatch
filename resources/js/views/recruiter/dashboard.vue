<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 p-6">
    <div class="max-w-6xl mx-auto">
      <!-- Header -->
      <div class="text-center mt-6 mb-10">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white">
          Our recruitment metrics dashboard 

        </h1>
        <br>
        <p class="mt-3 text-lg md:text-xl text-blue-300 font-medium">
          An effective recruitment dashboard to help you make informed decisions <br> and <br> perform comparative analysis
        </p>
      </div>
      <br><br>
      <div class="grid grid-cols-3 gap-8 mt-10">

  <!-- Left -->
  <div class="col-span-2 bg-[#1e293b] p-6 rounded-xl">
    <h2 class="text-xl font-semibold mb-4">Recent Jobs</h2>

    <div v-for="job in jobs" :key="job.id"
        class="flex justify-between items-center p-4 border-b border-slate-700">
      <div>
        <p class="font-semibold">{{ job.title }}</p>
        <p class="text-sm text-gray-400">
          {{ job.applicants }} applicants
        </p>
      </div>
      <div class="text-blue-400 font-bold">
        {{ job.avgMatch }}%
      </div>
    </div>

  </div>

  <!-- Right -->
  <div class="bg-[#1e293b] p-6 rounded-xl">
    <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>

    <button class="w-full bg-blue-600 py-3 rounded-lg mb-4">
      Create New Job
    </button>

    <button class="w-full border border-slate-600 py-3 rounded-lg">
      View Applications
    </button>
  </div>

  </div>
</div></div>
</template>
<script setup> 
import RecruiterSidebar from '../../components/RecruiterSidebar.vue';
import { ref } from 'vue'

const stats = ref([
  { title: 'Active Jobs', value: 12, change: '+4%' },
  { title: 'Applications', value: 86, change: '+12%' },
  { title: 'Avg Match Score', value: '74%', change: '+3%' },
  { title: 'Shortlisted', value: 18, change: '+2%' },
])

const jobs = ref([
  { id: 1, title: 'Frontend Developer', applicants: 23, avgMatch: 81 },
  { id: 2, title: 'Backend Developer', applicants: 15, avgMatch: 76 },
  { id: 3, title: 'DevOps Engineer', applicants: 9, avgMatch: 88 },
])
//up is placeholder data well replace with apis later
</script>
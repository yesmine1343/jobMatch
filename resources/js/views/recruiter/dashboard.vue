<template>
  <div class="min-h-screen flex items-center justify-center px-6 py-8">
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
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mt-10">

  <!-- Left -->
  <div class="lg:col-span-2 bg-[#1e293b] p-6 rounded-xl">
    <h2 class="text-xl font-semibold mb-4">Recent Jobs</h2>

    <div v-for="job in jobs" :key="job.id"
        class="flex justify-between items-center p-4 border-b border-slate-700">
      <div>
        <p class="font-semibold text-white">{{ job.title }}</p>
        <p class="text-sm text-gray-400">
          {{ job.applicants_count ?? 0 }} applicants
        </p>
        <p class="text-xs text-slate-400 mt-1">Department: {{ job.department || 'N/A' }} | Location: {{ job.location }}</p>
      </div>
      <div class="flex items-center gap-4">
        <button @click="() => goToApplications(job.id)" class="text-blue-400 hover:text-blue-600 text-sm">See Applications</button>
        <button @click="deleteJob(job.id)" class="text-red-400 hover:text-red-600 text-sm">Delete</button>
      </div>
    </div>

  </div>



  </div>
</div></div>
</template>
<script setup> 
import RecruiterSidebar from '../../components/RecruiterSidebar.vue';
import { ref } from 'vue'
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';

const stats = ref([
  { title: 'Active Jobs', value: 12, change: '+4%' },
  { title: 'Applications', value: 86, change: '+12%' },
  { title: 'Avg Match Score', value: '74%', change: '+3%' },
  { title: 'Shortlisted', value: 18, change: '+2%' },
])

const jobs = ref([])

const router = useRouter();
const redirect = () => {
  router.push('/recruiter/create-job');
}

// Fetch recruiter's jobs from correct endpoint
const fetchJobs = () => {
  axiosInstance.get('/api/recruiter/jobs/index')
    .then(response => {
      jobs.value = response.data;
    })
    .catch(error => {
      console.error('Error fetching recruiter jobs:', error);
    });
};

fetchJobs();

const deleteJob = (id) => {
  axiosInstance.delete(`/api/recruiter/jobs/${id}`)
    .then(() => {
      jobs.value = jobs.value.filter(job => job.id !== id);
    })
    .catch(error => {
      console.error('Error deleting job:', error);
    });
};

const goToApplications = (jobId) => {
  router.push({ name: 'applications', params: { jobId } });
};
</script>
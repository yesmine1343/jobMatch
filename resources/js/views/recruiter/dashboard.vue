<template>
  <div class="flex min-h-screen bg-gradient-to-br from-slate-900 to-slate-800">

    <RecruiterSidebar />

    <div class="flex-1 p-6">
      <div class="max-w-6xl mx-auto">
        <div class="text-center mt-6 mb-10">
          <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white">
            Recruiter Dashboard
          </h1>
          <p class="mt-3 text-lg md:text-xl text-blue-300 font-medium">
            An effective recruitment dashboard to help you make informed decisions
          </p>
        </div>

        <div class="bg-[#1e293b] p-6 rounded-xl">
          <h2 class="text-xl font-semibold mb-4 text-white">Recent Jobs</h2>
          <div v-for="job in jobs" :key="job.id"
              class="flex justify-between items-center p-4 border-b border-slate-700">
            <div>
              <p class="font-semibold text-white">{{ job.title }}</p>
              <p class="text-sm text-gray-400">{{ job.applicants_count ?? 0 }} applicants</p>
              <p class="text-xs text-slate-400 mt-1">
                Department: {{ job.department || 'N/A' }} | Location: {{ job.location }}
              </p>
            </div>
            <div class="flex items-center gap-4">
              <button @click="goToApplications(job.id)" class="text-blue-400 hover:text-blue-600 text-sm">See Applications</button>
              <button @click="deleteJob(job.id)" class="text-red-400 hover:text-red-600 text-sm">Delete</button>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import RecruiterSidebar from '../../components/RecruiterSidebar.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';

const jobs = ref([]);
const router = useRouter();

axiosInstance.get('/api/recruiter/jobs/index')
  .then(response => { jobs.value = response.data; })
  .catch(error => { console.error('Error fetching recruiter jobs:', error); });

const deleteJob = (id) => {
  axiosInstance.delete(`/api/recruiter/jobs/${id}`)
    .then(() => { jobs.value = jobs.value.filter(job => job.id !== id); })
    .catch(error => { console.error('Error deleting job:', error); });
};

const goToApplications = (jobId) => {
  router.push({ name: 'applications', params: { jobId } });
};
</script>

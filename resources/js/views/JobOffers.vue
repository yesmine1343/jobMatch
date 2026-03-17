<template>
  <div class="max-w-6xl mx-auto py-10">
    <h1 class="text-3xl font-bold text-white mb-8">Job Offers</h1>
    <div v-if="jobs.length === 0" class="text-slate-400">No job offers found.</div>
    <div v-for="job in jobs" :key="job.id" class="bg-slate-800 rounded-xl p-6 mb-6 flex justify-between items-center">
      <div>
        <h2 class="text-xl font-semibold text-white mb-1">{{ job.title }}</h2>
        <p class="text-slate-400 text-sm mb-1">Department: {{ job.department || 'N/A' }} | Location: {{ job.location }}</p>
        <p class="text-slate-400 text-sm mb-1">Experience: {{ job.required_experience_level || job.experienceLevel }}</p>
        <p class="text-slate-400 text-sm mb-1">Salary: {{ job.salary_min || job.salary }} TND</p>
      </div>
      <div class="flex gap-3">
        <button v-if="isRecruiter" @click="goToUpdate(job.id)" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update</button>
        <button v-if="isRecruiter" @click="deleteJob(job.id)" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Delete</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios';

const jobs = ref([]);
const router = useRouter();

const props = defineProps({
  isRecruiter: Boolean,
  recruiterOnly: Boolean
});

const fetchJobs = () => {
  let endpoint = '/api/jobs';
  if (props.isRecruiter && props.recruiterOnly) {
    endpoint = '/api/recruiter/jobs';
  }
  axiosInstance.get(endpoint)
    .then(res => { jobs.value = res.data; })
    .catch(err => { jobs.value = []; });
};

const goToUpdate = (jobId) => {
  router.push({ name: 'UpdateJob', params: { jobId } });
};

const deleteJob = (jobId) => {
  let endpoint = `/api/jobs/${jobId}`;
  if (props.isRecruiter) {
    endpoint = `/api/recruiter/jobs/${jobId}`;
  }
  axiosInstance.delete(endpoint)
    .then(() => {
      jobs.value = jobs.value.filter(j => j.id !== jobId);
    });
};

onMounted(fetchJobs);
</script>

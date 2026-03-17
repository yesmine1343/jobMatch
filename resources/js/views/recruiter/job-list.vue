<template>
  <div class="bg-white rounded shadow p-6 m-4 w-full lg:w-3/4 lg:max-w-lg">
    <div class="mb-6">
      <h1 class="text-grey-darkest">Job Offer List</h1>
    </div>

    <div class="max-h-screen-1/2 overflow-y-scroll">
      <div v-for="job in jobs" :key="job.id" class="flex items-center justify-between p-2 border-b">
        <span>{{ job.jobTitle }}</span>
        <div class="flex gap-2">
          <!-- Active/closed toggle -->
          <button
            @click="toggleJobStatus(job.id, job.status)"
            :class="job.status === 'active'
              ? 'bg-blue-600 text-white border-blue-600'
              : 'bg-gray-300 text-gray-600 border-gray-300'"
            class="p-2 border-2 rounded transition-all"
          >
            {{ job.status === 'active' ? 'active' : 'closed' }}
          </button>

          <!-- Update -->
          <button
            class="p-2 border-2 rounded text-blue-600 border-blue-600 hover:text-white hover:bg-blue-600"
            @click="goToEdit(job.id)"
          >
            Update
          </button>

          <!-- Remove -->
          <button
            class="p-2 border-2 rounded text-red-600 border-red-600 hover:text-white hover:bg-red-600"
            @click="requestRemoveJobOffer(job.id)"
          >
            Remove
          </button>
        </div>
      </div>
      <div v-show="jobs.length === 0">
        <p class="w-full text-center text-grey-dark">There are no job offers</p>
      </div>
    </div>



    
  </div>
</template>

<script>
import axiosInstance from '../../api/axios.js';

export default {
  data() {
    return {
      jobs: [],
      isLoading: false,
    };
  },
  created() {
    this.fetchJobOffers();
  },
  methods: {
    // ==========================================
    // FETCH: GET all jobs created by this recruiter
    // Endpoint: GET /api/recruiter/jobs/index
    // No ID needed - returns all jobs for authenticated recruiter
    // ==========================================
    async fetchJobOffers() {
      try {
        const { data } = await axiosInstance.get('/api/recruiter/jobs/index');
        this.jobs = data;
      } catch (error) {
        console.error('Error fetching jobs:', error);
      }
    },

    // ==========================================
    // CREATE: POST new job to database
    // Endpoint: POST /api/recruiter/jobs
    // Receives: formData object with job details
    // Returns: Created job object with auto-generated ID from database
    // Flow: Form submits → Backend stores → Returns job with ID → Add to jobs array
    // ==========================================
    async handleAddJobOffer(formData) {
      if (this.isLoading) return;
      this.isLoading = true;
      try {
        const { data } = await axiosInstance.post('/api/recruiter/jobs', formData);
        // 'data' is the newly created job with its database ID
        // Front-load it to show immediately in the list
        this.jobs.unshift(data);
      } catch (error) {
        console.error('Error creating job:', error);
      } finally {
        this.isLoading = false;
      }
    },

    async requestRemoveJobOffer(id) {
      try {
        await axiosInstance.delete(`/api/recruiter/jobs/${id}`);
        this.jobs = this.jobs.filter(job => job.id !== id);
      } catch (error) {
        console.error('Error deleting job:', error);
      }
    },
    goToEdit(id) {
      this.$router.push({ name: 'JobEdit', params: { id } });
    },

    async toggleJobStatus(id, currentStatus) {
      const newStatus = currentStatus === 'active' ? 'expired' : 'active';
      try {
        await axiosInstance.patch(`/api/recruiter/jobs/${id}/status`, { status: newStatus });
        const job = this.jobs.find(j => j.id === id);
        if (job) job.status = newStatus;
      } catch (error) {
        console.error('Error toggling status:', error);
      }
    },
  },
};
</script>
<template>
  <div class="min-h-screen flex items-center justify-center px-6 py-8">
    <div class="bg-slate-800 rounded-2xl px-8 py-10 md:px-12 md:py-12 max-w-6xl w-full shadow-2xl">
      <div class="flex justify-between items-center mb-2">
        <h1 class="text-white text-3xl md:text-4xl font-semibold">Create Job Offer</h1>
      </div>
      <p class="text-slate-400 text-base md:text-lg mb-10">Define the role requirements and expectations</p>

      <JobRoleBasics :formData="formData" />
      <JobExperienceComp :formData="formData" />
      <JobRequiredSkills
        :formData="formData"
        :newMustHaveSkill="newMustHaveSkill"
        :addMustHaveSkill="addMustHaveSkill"
        :removeMustHaveSkill="removeMustHaveSkill"
      />
      <JobOptionalSkills
        :formData="formData"
        :removeNiceToHaveSkill="removeNiceToHaveSkill"
      />
      <JobCultureFit
        :formData="formData"
        :toggleSoftSkill="toggleSoftSkill"
      />

      <div class="flex gap-3">
        <button
          @click="requestAdd"
          :disabled="isLoading"
          class="flex-1 bg-blue-600 text-white rounded-xl px-8 py-4 text-base md:text-lg font-semibold hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed transition-all"
          type="button"
        >
          {{ isLoading ? 'Submitting...' : 'Continue' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axiosInstance from '../../api/axios.js';
import JobRoleBasics from '../../components/JobRoleBasics.vue';
import JobExperienceComp from '../../components/JobExperienceComp.vue';
import JobRequiredSkills from '../../components/JobRequiredSkills.vue';
import JobOptionalSkills from '../../components/JobOptionalSkills.vue';
import JobCultureFit from '../../components/JobCultureFit.vue';

const router = useRouter();
const isLoading = ref(false);

const formData = reactive({
  jobTitle: '',
  department: '',
  location: '',
  workModel: 'Hybrid',
  employmentTypes: ['Full-time'],
  experienceLevel: 'Mid',
  salary: 4000,
  mustHaveSkills: [],
  niceToHaveSkills: [],
  softSkills: []
});

const newMustHaveSkill = reactive({ name: '', years: 2, weight: 3 });

const addMustHaveSkill = () => {
  if (newMustHaveSkill.name.trim()) {
    formData.mustHaveSkills.push({ ...newMustHaveSkill });
    newMustHaveSkill.name = '';
    newMustHaveSkill.years = 2;
    newMustHaveSkill.weight = 3;
  }
};
const removeMustHaveSkill = (index) => {
  formData.mustHaveSkills.splice(index, 1);
};
const removeNiceToHaveSkill = (index) => {
  formData.niceToHaveSkills.splice(index, 1);
};
const toggleSoftSkill = (skill) => {
  const index = formData.softSkills.indexOf(skill);
  if (index > -1) {
    formData.softSkills.splice(index, 1);
  } else {
    formData.softSkills.push(skill);
  }
};

// Submit the form via axios
const requestAdd = async () => {
  if (isLoading.value) return;
  
  isLoading.value = true;
  
  try {
    console.log('📤 Submitting job offer:', formData);
    
    const { data } = await axiosInstance.post('/api/recruiter/jobs', formData);
    
    console.log('✅ Job created successfully:', data);
    
    // Redirect back to job list
    router.push({ name: 'JobList' });
    
  } catch (error) {
    console.error('❌ Error creating job:');
    console.error('Status:', error.response?.status);
    console.error('Message:', error.response?.data?.message);
    console.error('Errors:', error.response?.data?.errors);
    console.error('Full error:', error.response?.data || error.message);
    
    // Show more detailed error message
    const errorMsg = error.response?.data?.message || error.response?.data?.error || error.message;
    alert('Failed to create job:\n\n' + errorMsg);
  } finally {
    isLoading.value = false;
  }
};
</script>
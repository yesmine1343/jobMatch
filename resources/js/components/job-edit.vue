<template>
  <div class="min-h-screen flex items-center justify-center px-6 py-8">
    <div class="bg-slate-800 rounded-2xl px-8 py-10 md:px-12 md:py-12 max-w-6xl w-full shadow-2xl">
      <h1 class="text-white text-3xl md:text-4xl font-semibold mb-2">Edit Job Offer</h1>
      <p class="text-slate-400 text-base md:text-lg mb-10">Update the role requirements and expectations</p>

      <div v-if="pageLoading" class="text-white text-center py-20">Loading...</div>

      <template v-else>
        <JobRoleBasics :formData="formData" />
        <JobExperienceComp :formData="formData" />
        <JobRequiredSkills
          :formData="formData"
          :newMustHaveSkill="newMustHaveSkill"
          :addMustHaveSkill="addMustHaveSkill"
          :removeMustHaveSkill="removeMustHaveSkill"
        />
        <JobOptionalSkills :formData="formData" :removeNiceToHaveSkill="removeNiceToHaveSkill" />
        <JobCultureFit :formData="formData" :toggleSoftSkill="toggleSoftSkill" />

        <div class="flex gap-3 mt-6">
          <button @click="$router.push({ name: 'JobList' })" type="button"
            class="flex-1 bg-slate-600 text-white rounded-xl px-8 py-4 text-lg font-semibold hover:bg-slate-700">
            Cancel
          </button>
          <button @click="submitUpdate" :disabled="isLoading" type="button"
            class="flex-1 bg-blue-600 text-white rounded-xl px-8 py-4 text-lg font-semibold hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed">
            {{ isLoading ? 'Saving...' : 'Save Changes' }}
          </button>
        </div>
      </template>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axiosInstance from '../api/axios.js';
import JobRoleBasics from './JobRoleBasics.vue';
import JobExperienceComp from './JobExperienceComp.vue';
import JobRequiredSkills from './JobRequiredSkills.vue';
import JobOptionalSkills from './JobOptionalSkills.vue';
import JobCultureFit from './JobCultureFit.vue';

const route = useRoute();
const router = useRouter();
const isLoading = ref(false);
const pageLoading = ref(true);

const formData = reactive({
  jobTitle: '', department: '', location: '',
  workModel: 'Hybrid', employmentTypes: ['Full-time'],
  experienceLevel: 'Mid', salary: 4000,
  mustHaveSkills: [], niceToHaveSkills: [], softSkills: []
});

const newMustHaveSkill = reactive({ name: '', years: 2, weight: 3 });

// Pre-fill form from API
onMounted(async () => {
  try {
    const { data } = await axiosInstance.get(`/api/recruiter/jobs/${route.params.id}`);
    Object.assign(formData, data);
  } catch (error) {
    console.error('Error fetching job:', error);
  } finally {
    pageLoading.value = false;
  }
});

const addMustHaveSkill = () => {
  if (newMustHaveSkill.name.trim()) {
    formData.mustHaveSkills.push({ ...newMustHaveSkill });
    newMustHaveSkill.name = '';
    newMustHaveSkill.years = 2;
    newMustHaveSkill.weight = 3;
  }
};
const removeMustHaveSkill = (index) => formData.mustHaveSkills.splice(index, 1);
const removeNiceToHaveSkill = (index) => formData.niceToHaveSkills.splice(index, 1);
const toggleSoftSkill = (skill) => {
  const index = formData.softSkills.indexOf(skill);
  index > -1 ? formData.softSkills.splice(index, 1) : formData.softSkills.push(skill);
};

const submitUpdate = async () => {
  isLoading.value = true;
  try {
    await axiosInstance.put(`/api/recruiter/jobs/${route.params.id}`, { ...formData });
    router.push({ name: 'JobList' });
  } catch (error) {
    console.error('Error updating job:', error);
  } finally {
    isLoading.value = false;
  }
};
</script>
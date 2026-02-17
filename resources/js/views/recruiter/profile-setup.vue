<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center p-5">
    <div class="bg-slate-800 rounded-xl p-10 max-w-3xl w-full shadow-2xl">
      
      <!-- Header -->
      <p class="text-slate-400 text-sm mb-8">Set up your company profile to get started</p>

      <!-- Company Name -->
      <div class="mb-6">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Company Name</label>
        <input 
          v-model="formData.companyName" 
          type="text" 
          placeholder="Enter your company name..."
          class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
        />
      </div>

      <!-- Industry -->
      <div class="mb-6">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Industry</label>
        <div class="relative">
          <select 
            v-model="formData.industry" 
            class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 cursor-pointer appearance-none"
          >
            <option value="">Select industry...</option>
            <option value="technology">Information Technology</option>
            <option value="finance">Finance</option>
            <option value="healthcare">Healthcare</option>
            <option value="education">Education</option>
            <option value="retail">Retail</option>
            <option value="manufacturing">Manufacturing</option>
            <option value="consulting">Consulting</option>
          </select>
          <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </div>

      <!-- Company Size -->
      <div class="mb-6">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Company Size</label>
        <div class="flex gap-3">
          <button 
            v-for="size in ['1-10', '11-50', '51-200', '201-500', '500+']" 
            :key="size"
            :class="[
              'flex-1 px-4 py-2.5 rounded-lg text-sm font-medium transition-all',
              formData.companySize === size 
                ? 'bg-blue-600 text-white' 
                : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
            ]"
            @click="formData.companySize = size"
            type="button"
          >
            {{ size }}
          </button>
        </div>
      </div>

      <!-- Default Hiring Location -->
      <div class="mb-6">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Default Hiring Location</label>
        <input 
          v-model="formData.hiringLocation" 
          type="text" 
          placeholder="Start typing location..."
          class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
        />
        <span class="block text-slate-500 text-xs mt-1.5">Type to search cities, countries, or regions</span>
      </div>

      <!-- Default Work Model -->
      <div class="mb-8">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Default Work Model</label>
        <div class="flex gap-3">
          <button 
            v-for="model in ['Remote', 'Hybrid', 'On-site']" 
            :key="model"
            :class="[
              'flex-1 px-6 py-2.5 rounded-lg text-sm font-medium transition-all',
              formData.workModel === model 
                ? 'bg-blue-600 text-white' 
                : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
            ]"
            @click="formData.workModel = model"
            type="button"
          >
            {{ model }}
          </button>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex gap-3">
        <button 
          @click="submit"
          :disabled="isLoading"
          class="flex-1 bg-blue-600 text-white rounded-lg px-6 py-3 text-sm font-medium hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed transition-all"
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
import { useRoute,useRouter } from 'vue-router';

const router = useRouter();
const isLoading = ref(false);

const formData = reactive({
  companyName: '',
  industry: '',
  companySize: '11-50',
  hiringLocation: '',
  workModel: 'Hybrid'
});

const submit = async () => {
  // Prevent multiple submissions
  if (isLoading.value) return;
  
  isLoading.value = true;
  
  try {
    // Handle Laravel API call
    // await axiosInstance.post('/api/recruiter/profile', formData);
    
    console.log('Recruiter Setup:', formData);
    router.push({name:'Rdashboard'});
  } catch (error) {
    console.error('Error submitting profile:', error);
  } finally {
    isLoading.value = false;
  }
};
</script>
<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center p-5">
    <div class="bg-slate-800 rounded-xl p-10 max-w-3xl w-full shadow-2xl">
      
      <!-- Header -->
      <div class="flex justify-between items-center mb-2">
        <h1 class="text-white text-2xl font-semibold">Complete Your Candidate Profile</h1>
      </div>
      <p class="text-slate-400 text-sm mb-8">We'll use this to match you with the most relevant jobs</p>

      <!-- Target Job Title -->
      <div class="mb-6">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Target Job Title</label>
        <input 
          v-model="formData.jobTitle" 
          type="text" 
          placeholder="Frontend Developer, Data Analyst..."
          class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
        />
        <span class="block text-slate-500 text-xs mt-1.5">Used to match job titles and similarity score</span>
      </div>

      <!-- Experience Level -->
      <div class="mb-6">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Experience Level</label>
        <div class="flex gap-3">
          <button 
            v-for="level in ['Junior', 'Mid', 'Senior', 'Lead']" 
            :key="level"
            :class="[
              'px-6 py-2.5 rounded-lg text-sm font-medium transition-all',
              formData.experienceLevel === level 
                ? 'bg-blue-600 text-white' 
                : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
            ]"
            @click="formData.experienceLevel = level"
            type="button"
          >
            {{ level }}
          </button>
        </div>
      </div>

      <!-- Work Type & Employment Type -->
      <div class="grid grid-cols-2 gap-6 mb-6">
        <!-- Work Type -->
        <div>
          <label class="block text-slate-200 text-sm font-medium mb-2.5">Work Type</label>
          <div class="flex gap-3">
            <button 
              v-for="type in ['Remote', 'Hybrid', 'On-site']" 
              :key="type"
              :class="[
                'px-5 py-2.5 rounded-lg text-sm font-medium transition-all',
                formData.workType === type 
                  ? 'bg-blue-600 text-white' 
                  : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
              ]"
              @click="formData.workType = type"
              type="button"
            >
              {{ type }}
            </button>
          </div>
        </div>

        <!-- Employment Type -->
        <div>
          <label class="block text-slate-200 text-sm font-medium mb-2.5">Employment Type</label>
          <div class="flex flex-wrap gap-2.5">
            <button 
              v-for="type in ['Full-time', 'Part-time', 'Contract', 'Internship']" 
              :key="type"
              :class="[
                'px-5 py-2.5 rounded-lg text-sm font-medium transition-all',
                formData.employmentType === type 
                  ? 'bg-blue-600 text-white' 
                  : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
              ]"
              @click="formData.employmentType = type"
              type="button"
            >
              {{ type }}
            </button>
          </div>
        </div>
      </div>

      <!-- Expected Monthly Salary -->
      <div class="mb-6">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Expected Monthly Salary</label>
        <input 
          v-model.number="formData.salary" 
          type="range" 
          min="500" 
          max="6000" 
          step="100"
          class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600"
        />
        <div class="flex justify-between items-center mt-2.5 text-sm">
          <span class="text-slate-400">500 TND</span>
          <span class="text-blue-500 font-semibold">{{ formData.salary }} TND</span>
          <span class="text-slate-400">6000 TND</span>
        </div>
      </div>

      <!-- Availability -->
      <div class="mb-6">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Availability</label>
        <select 
          v-model="formData.availability" 
          class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 cursor-pointer"
        >
          <option value="immediately">Available to start: Immediately</option>
          <option value="1-week">Available to start: 1 week</option>
          <option value="2-weeks">Available to start: 2 weeks</option>
          <option value="1-month">Available to start: 1 month</option>
          <option value="2-months">Available to start: 2+ months</option>
        </select>
      </div>

      <!-- Location Preference -->
      <div class="mb-8">
        <label class="block text-slate-200 text-sm font-medium mb-2.5">Location Preference</label>
        <input 
          v-model="formData.location" 
          type="text" 
          placeholder="Type location and press Enter..."
          class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
        />
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
import { useRouter,useRoute } from 'vue-router';

const router = useRouter();
const route = useRoute();
const isLoading = ref(false);

const formData = reactive({
  jobTitle: '',
  experienceLevel: 'Mid',
  workType: 'Remote',
  employmentType: 'Full-time',
  salary: 4000,
  availability: 'immediately',
  location: ''
});

const submit = async () => {
  // Prevent multiple submissions
  if (isLoading.value) return;
  
  isLoading.value = true;
  
  try {
    // Handle Laravel API call here
    // await axiosInstance.post('/api/candidate/profile', formData);
    
    router.push({ name: 'Cdashboard' });
  } catch (error) {
    console.error('Error submitting profile:', error);
  } finally {
    isLoading.value = false;
  }
};

</script>
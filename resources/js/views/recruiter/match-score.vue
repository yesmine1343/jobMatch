<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center px-6 py-8">
    <div class="bg-slate-800 rounded-2xl px-8 py-10 md:px-12 md:py-12 max-w-6xl w-full shadow-2xl">
      
      <!-- Header -->
      <div class="flex justify-between items-center mb-2">
        <h1 class="text-white text-3xl md:text-4xl font-semibold">Match Results Filter</h1>
        <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-base font-semibold">Step 3 of 3</span>
      </div>
      <p class="text-slate-400 text-base md:text-lg mb-10">Refine candidate matches based on your preferences</p>

      <!-- Skill Strictness -->
      <div class="mb-6">
        <div class="flex items-center justify-between">
          <div>
            <label class="block text-slate-200 text-sm font-medium">Skill Strictness</label>
            <p class="text-slate-500 text-xs mt-0.5">Require exact skill matches</p>
          </div>
          <button 
            @click="formData.skillStrictness = !formData.skillStrictness"
            :class="[
              'relative inline-flex h-6 w-11 items-center rounded-full transition-colors',
              formData.skillStrictness ? 'bg-blue-600' : 'bg-slate-600'
            ]"
            type="button"
          >
            <span 
              :class="[
                'inline-block h-4 w-4 transform rounded-full bg-white transition-transform',
                formData.skillStrictness ? 'translate-x-6' : 'translate-x-1'
              ]"
            />
          </button>
        </div>
      </div>

      <!-- Experience Level Filter -->
      <div class="mb-6">
        <label class="block text-slate-200 text-base font-medium mb-3">Experience Level Filter</label>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
          <button 
            v-for="level in ['Junior', 'Mid', 'Senior', 'Lead', 'All']" 
            :key="level"
            :class="[
              'px-6 py-3 rounded-xl text-base font-medium transition-all',
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

      <!-- Salary Expectation Filter -->
      <div class="mb-6">
        <label class="block text-slate-200 text-base font-medium mb-3">Salary Expectation Filter</label>
        <div class="space-y-4">
          <div>
            <div class="flex justify-between mb-2">
              <span class="text-slate-400 text-xs">Minimum Salary</span>
              <span class="text-blue-500 text-sm font-semibold">{{ formData.salaryMin }} TND</span>
            </div>
            <input 
              v-model.number="formData.salaryMin" 
              type="range" 
              min="2000" 
              max="10000" 
              step="500"
              class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600"
            />
          </div>
          <div>
            <div class="flex justify-between mb-2">
              <span class="text-slate-400 text-xs">Maximum Salary</span>
              <span class="text-blue-500 text-sm font-semibold">{{ formData.salaryMax }} TND</span>
            </div>
            <input 
              v-model.number="formData.salaryMax" 
              type="range" 
              min="2000" 
              max="10000" 
              step="500"
              class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600"
            />
          </div>
        </div>
        <div class="mt-3 p-3 bg-slate-900 rounded-lg">
          <div class="flex justify-between items-center">
            <span class="text-slate-400 text-xs">Selected Range:</span>
            <span class="text-white text-sm font-medium">{{ formData.salaryMin }} - {{ formData.salaryMax }} TND</span>
          </div>
        </div>
      </div>

      <!-- Availability -->
      <div class="mb-6">
        <label class="block text-slate-200 text-base font-medium mb-3">Availability</label>
        <div class="relative">
          <select 
            v-model="formData.availability" 
            class="w-full bg-slate-900 border border-slate-600 rounded-xl px-5 py-3.5 text-white text-base focus:outline-none focus:border-blue-500 cursor-pointer appearance-none"
          >
            <option value="any">Any availability</option>
            <option value="immediately">Immediately</option>
            <option value="1-week">Within 1 week</option>
            <option value="2-weeks">Within 2 weeks</option>
            <option value="1-month">Within 1 month</option>
            <option value="2-months">Within 2+ months</option>
          </select>
          <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </div>

      <!-- Location Flexibility -->
      <div class="mb-8">
        <label class="block text-slate-200 text-base font-medium mb-3">Location Flexibility</label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
          <button 
            v-for="option in ['Remote Only', 'Hybrid', 'On-site', 'Any Location']" 
            :key="option"
            :class="[
              'px-4 py-3 rounded-xl text-base font-medium transition-all',
              formData.locationFlexibility === option 
                ? 'bg-blue-600 text-white' 
                : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
            ]"
            @click="formData.locationFlexibility = option"
            type="button"
          >
            {{ option }}
          </button>
        </div>
      </div>

      <!-- Filter Summary -->
      <div class="mb-8 p-4 bg-slate-900 rounded-lg border border-slate-700">
        <h3 class="text-slate-300 text-base font-semibold mb-3">Active Filters</h3>
        <div class="space-y-2">
          <div class="flex items-center justify-between text-xs">
            <span class="text-slate-400">Skill Strictness:</span>
            <span :class="formData.skillStrictness ? 'text-green-400' : 'text-slate-500'">
              {{ formData.skillStrictness ? 'Enabled' : 'Disabled' }}
            </span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-slate-400">Experience Level:</span>
            <span class="text-blue-400">{{ formData.experienceLevel }}</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-slate-400">Salary Range:</span>
            <span class="text-blue-400">{{ formData.salaryMin }} - {{ formData.salaryMax }} TND</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-slate-400">Availability:</span>
            <span class="text-blue-400">{{ formData.availability }}</span>
          </div>
          <div class="flex items-center justify-between text-xs">
            <span class="text-slate-400">Location:</span>
            <span class="text-blue-400">{{ formData.locationFlexibility }}</span>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex gap-3">
        <button 
          @click="clearFilters"
          class="px-6 py-4 bg-transparent border border-slate-600 text-slate-300 rounded-xl text-base font-semibold hover:bg-slate-700 transition-all"
          type="button"
        >
          Clear Filters
        </button>
        <button 
          @click="applyFilters"
          class="flex-1 bg-blue-600 text-white rounded-xl px-6 py-4 text-base font-semibold hover:bg-blue-700 transition-all"
          type="button"
        >
          Apply Filters
        </button>
      </div>

    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue';

const formData = reactive({
  skillStrictness: true,
  experienceLevel: 'Mid',
  salaryMin: 3000,
  salaryMax: 7000,
  availability: 'any',
  locationFlexibility: 'Any Location'
});

const clearFilters = () => {
  formData.skillStrictness = false;
  formData.experienceLevel = 'All';
  formData.salaryMin = 2000;
  formData.salaryMax = 10000;
  formData.availability = 'any';
  formData.locationFlexibility = 'Any Location';
};

const applyFilters = () => {
  console.log('Applied Filters:', formData);
  // Handle Laravel API call
};
</script>
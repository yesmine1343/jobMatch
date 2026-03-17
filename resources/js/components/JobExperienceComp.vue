<template>
  <div class="mb-8">
    <h2 class="text-slate-200 text-2xl font-semibold mb-5">Experience & Compensation</h2>
    <div class="mb-6">
      <label class="block text-slate-200 text-base font-medium mb-3">Experience Level</label>
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <button 
          v-for="level in ['Junior', 'Mid', 'Senior', 'Lead']" 
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
    <div class="mb-6">
      <label class="block text-slate-200 text-base font-medium mb-3">Salary Range</label>
      <input 
        v-model.number="formData.salary" 
        type="range" 
        min="500" 
        max="6000" 
        step="100"
        class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600"
      />
      <div class="flex justify-between items-center mt-3 text-base">
        <span class="text-slate-400">500 TND</span>
        <span class="text-blue-500 font-semibold">{{ formData.salary }} TND</span>
        <span class="text-slate-400">6000 TND</span>
      </div>
    </div>
    <slot />
  </div>
</template>

<script setup>
const props = defineProps({
  formData: Object
});
</script>

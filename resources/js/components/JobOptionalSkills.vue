<template>
  <div class="mb-8">
    <h2 class="text-slate-200 text-2xl font-semibold mb-5">Optional Skills</h2>
    <div class="mb-6">
      <label class="block text-slate-200 text-base font-medium mb-3">Nice-to-Have Skills</label>
      <div class="flex flex-wrap gap-2 mb-3">
        <div 
          v-for="(skill, index) in formData.niceToHaveSkills" 
          :key="index"
          class="bg-slate-700 rounded-lg px-3 py-2 flex items-center gap-2"
        >
          <span class="text-white text-base">{{ skill }}</span>
          <button 
            @click="removeNiceToHaveSkill(index)"
            class="text-slate-400 hover:text-red-400"
            type="button"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
      <div class="flex gap-3">
        <input 
          v-model="localSkill"
          type="text" 
          placeholder="Add optional skill and press Enter"
          @keyup.enter="addSkill"
          class="flex-1 bg-slate-900 border border-slate-600 rounded-xl px-5 py-3 text-white text-base focus:outline-none focus:border-blue-500 placeholder-slate-500"
        />
        <button 
          @click="addSkill"
          class="bg-slate-700 text-white px-6 rounded-xl text-base font-semibold hover:bg-slate-600 transition-all"
          type="button"
        >
          Add
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  formData: Object,
  removeNiceToHaveSkill: Function
});

const localSkill = ref('');

const addSkill = () => {
  if (localSkill.value.trim()) {
    props.formData.niceToHaveSkills.push(localSkill.value.trim());
    localSkill.value = '';
  }
};
</script>
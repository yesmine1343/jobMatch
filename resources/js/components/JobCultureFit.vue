  <template>
    <div class="mb-8">
      <h2 class="text-slate-200 text-2xl font-semibold mb-5">Culture Fit</h2>
      <div class="mb-6">
        <label class="block text-slate-200 text-base font-medium mb-3">Preferred Soft Skills</label>
        <div class="flex flex-wrap gap-2.5">
          <button 
            v-for="skill in softSkillsList" 
            :key="skill"
            :class="[
              'px-5 py-3 rounded-xl text-base font-medium transition-all',
              formData.softSkills.includes(skill)
                ? 'bg-blue-600 text-white' 
                : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
            ]"
            @click="toggleSoftSkill(skill)"
            type="button"
          >
            {{ skill }}
          </button>
        </div>
        <span class="block text-slate-500 text-xs mt-1.5">Select multiple options</span>
      </div>
    </div>
  </template>

  <script setup>
  const props = defineProps({
    formData: Object,
    toggleSoftSkill: Function
  });

  const softSkillsList = [
    'Team Player', 'Leadership', 'Communication', 'Problem Solving', 'Adaptability', 'Creativity', 'Time Management'
  ];
  </script>

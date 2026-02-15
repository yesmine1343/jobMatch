<template>
  <div class="min-h-screen bg-[#0f172a] py-12 px-4">
    <div class="max-w-5xl mx-auto space-y-8">
      
      <!-- Page Header -->
      <div class="text-center space-y-2">
        <h1 class="text-3xl font-bold text-white tracking-tight">My Skills Profile</h1>
        <p class="text-slate-400 text-sm italic">
          Set your current skills to get personalized job matches and learning recommendations
        </p>
      </div>

      <!-- Main Skills Card -->
      <div class="bg-[#1e293b]/50 border border-slate-700/50 rounded-xl p-8 shadow-xl backdrop-blur-sm">
        <div class="space-y-6">
          <div class="space-y-4">
            <h3 class="text-blue-400 font-bold text-lg">Your Current Skills</h3>
            
            <!-- Skills Tags -->
            <div class="flex flex-wrap gap-3 items-center">
              <div v-for="skill in skills" :key="skill" 
                   class="px-5 py-2 rounded-full bg-blue-600 text-white font-medium text-sm transition-transform hover:scale-105 cursor-default shadow-lg shadow-blue-500/20">
                {{ skill }}
              </div>
              
              <!-- Add Skill Button -->
              <button class="px-5 py-2 rounded-full border-2 border-dashed border-slate-600 text-slate-400 text-sm font-medium hover:border-blue-500 hover:text-blue-400 transition-all duration-200">
                + Add Skill
              </button>
            </div>
          </div>

          <!-- Experience Level Section -->
          <div class="space-y-3 pt-4">
            <label class="block text-slate-400 text-sm font-medium">Experience Level</label>
            <div class="relative group">
              <select v-model="experienceLevel" 
                      class="w-full bg-[#0f172a] border border-slate-700 text-slate-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-3 pr-10 appearance-none cursor-pointer transition-colors hover:border-slate-500">
                <option value="entry">Entry-level (0-2 years)</option>
                <option value="mid">Mid-level (2-5 years)</option>
                <option value="senior">Senior-level (5-10 years)</option>
                <option value="expert">Expert (10+ years)</option>
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Profile Match Score Card -->
      <div class="bg-[#1e293b]/50 border border-slate-700/50 rounded-xl p-8 shadow-xl backdrop-blur-sm">
        <div class="flex flex-col space-y-6">
          <div class="flex items-center justify-between">
            <h3 class="text-blue-400 font-bold text-lg tracking-wide">Profile Match Score</h3>
            <div class="px-4 py-2 bg-emerald-500 text-white font-bold text-2xl rounded-lg shadow-lg shadow-emerald-500/20">
              78%
            </div>
          </div>
          
          <p class="text-slate-300 leading-relaxed">
            Based on your skills, you match <span class="text-blue-400 font-bold underline cursor-pointer hover:text-blue-300">342 jobs</span> in our database. 
            Top matches are in <span class="text-blue-400 font-semibold cursor-pointer hover:underline">Backend Development</span> and <span class="text-blue-400 font-semibold cursor-pointer hover:underline">Full-Stack Engineering</span>.
          </p>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const skills = ref(['Laravel', 'PHP', 'MySQL', 'Git'])
const experienceLevel = ref('mid')
</script>

<style scoped>
/* Custom dropdown styling to remove default browser arrow */
select {
  background-image: none;
}
</style>

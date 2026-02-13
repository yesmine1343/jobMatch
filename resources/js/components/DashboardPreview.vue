<template>
  <div class="w-full max-w-5xl mx-auto p-8 rounded-2xl bg-[#0a0f1e] shadow-2xl border border-slate-800/50">
    <!-- Header Section -->
    <div class="text-center mb-10 space-y-4">
      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20 animate-pulse">
        <span class="w-2 h-2 mr-2 rounded-full bg-blue-400"></span>
        Preview Dashboard
      </span>
      
      <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
        Main Dashboard Overview
      </h2>
      
      <p class="max-w-2xl mx-auto text-lg text-slate-400 leading-relaxed">
        Unlock real-time market trends and salary benchmarks tailored to your professional profile.
      </p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-8">
      <div v-for="stat in stats" :key="stat.label" 
           class="relative overflow-hidden group p-6 rounded-xl bg-[#161e31] border border-slate-700/20 hover:border-blue-500/30 transition-all duration-300">
        <!-- Lock Icon -->
        <div class="absolute top-3 right-3 text-slate-600 group-hover:text-blue-400/50 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
        </div>
        
        <p class="text-sm font-medium text-slate-400 mb-1">{{ stat.label }}</p>
        <p class="text-2xl font-bold text-white tracking-tight">{{ stat.value }}</p>
      </div>
    </div>

    <!-- Chart Area with Locked Overlay -->
    <div class="relative rounded-xl overflow-hidden border border-slate-700/50 bg-[#161e31]">
      <!-- Placeholder Chart Image -->
      <div class="opacity-60 blur-sm grayscale-[0.5]">
        <img 
          src="C:\Users\yesmi\chaps\jobMatch_\jobMatch\images\chartprev.png" 
          alt="Market Insights Graph" 
          class="w-full h-auto min-h-[300px] object-cover"
        />
      </div>

      <!-- Lock Overlay -->
      <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center backdrop-blur-[1.5px] bg-[#0a0f1e]/10 transition-all duration-500">
        <div class="bg-blue-600/20 p-4 rounded-full mb-6 border border-blue-500/30 animate-bounce">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
        </div>
        
        <h3 class="text-xl font-semibold text-white mb-2">Ready to see your insights?</h3>
        <p class="text-slate-300 max-w-sm mb-8 leading-relaxed">
          Complete your profile to unlock personalized data and track salary trends for your specific industry.
        </p>
        
        <button 
          @click="$emit('setup')"
          class="group relative inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-200 bg-blue-600 rounded-lg hover:bg-blue-500 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-[#0a0f1e]"
        >
          <span class="absolute inset-x-0 bottom-0 h-1 bg-blue-700 rounded-b-lg"></span>
          Set Up Profile
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
const stats = [
  { label: 'Verified Opportunities', value: '2.8K+' },
  { label: 'Avg Salary Range', value: '$70K–$85K' },
  { label: 'Active Companies', value: '150+' },
  { label: 'Top Skills Tracked', value: '45+' }
]

defineEmits(['setup'])
</script>

<style scoped>
/* Any custom styles not covered by Tailwind */
.backdrop-blur-sm {
  backdrop-filter: blur(4px);
}
</style>

<template>
  <div class="max-w-4xl mx-auto p-8 mt-10 bg-slate-800 rounded-2xl border border-slate-700 shadow-xl">
    <div class="flex items-center gap-6 mb-8 pb-8 border-b border-slate-700">
      <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center text-3xl font-bold text-white shadow-lg shadow-blue-500/20">
        JD
      </div>
      <div>
        <h1 class="text-3xl font-bold text-white tracking-tight">Candidate Profile</h1>
        <p class="text-slate-400">Complete your profile to unlock personalized job matches.</p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Form placeholder -->
      <div class="space-y-6">
        <h2 class="text-xl font-semibold text-white">Basic Information</h2>
        <div class="space-y-4">
          <div class="h-10 bg-slate-700/50 rounded-lg animate-pulse w-full"></div>
          <div class="h-10 bg-slate-700/50 rounded-lg animate-pulse w-3/4"></div>
          <div class="h-24 bg-slate-700/50 rounded-lg animate-pulse w-full"></div>
        </div>
      </div>

      <div class="bg-blue-600/5 rounded-xl p-6 border border-blue-500/10 h-min">
        <h3 class="text-blue-400 font-bold text-sm uppercase tracking-wider mb-4">Pro Tip</h3>
        <p class="text-slate-300 text-sm leading-relaxed">
          Candidates with a complete profile are 70% more likely to get noticed by top recruiters.
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>

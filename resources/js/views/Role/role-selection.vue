<template>
  <div class="min-h-screen flex items-center justify-start pl-24">
    <div class="space-y-8 max-w-4xl">
      <div class="space-y-2">
        <h2 class="text-3xl font-bold text-white">
          How will you use JobMatch?
        </h2>
        <p class="text-slate-400 text-lg font-medium">Please select your preferred role to continue.</p>
      </div>

      <div class="flex gap-8">
        <!-- Candidate Card -->
        <div
          class="group relative flex flex-col items-center justify-center w-72 h-80 bg-indigo-300 rounded-xl shadow-2xl border-2 border-slate-200 cursor-pointer hover:scale-105 transition-all duration-300 p-8"
          @click="onClick('candidate')"
        >
          <div class="w-32 h-32 mb-6 bg-white/50 rounded-full flex items-center justify-center p-4 shadow-inner group-hover:bg-white/80 transition-colors">
            <!-- Icon placeholder - Job search icon -->
            <svg class="w-16 h-16 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-slate-900 text-xl font-bold mb-2 uppercase tracking-wide">Candidate</h3>
          <p class="text-slate-700 text-sm text-center font-semibold">I am looking for a job and want to showcase my skills.</p>
          
          <!-- Indicator -->
          <div class="absolute bottom-6 right-6 text-blue-700 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </div>
        </div>

        <!-- Recruiter Card -->
        <div
          class="group relative flex flex-col items-center justify-center w-72 h-80 bg-indigo-300 rounded-xl shadow-2xl border-2 border-slate-200 cursor-pointer hover:scale-105 transition-all duration-300 p-8"
          @click="onClick('recruiter')"
        >
          <div class="w-32 h-32 mb-6 bg-white/50 rounded-full flex items-center justify-center p-4 shadow-inner group-hover:bg-white/80 transition-colors">
            <!-- Icon placeholder - Search people icon -->
            <svg class="w-16 h-16 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <h3 class="text-slate-900 text-xl font-bold mb-2 uppercase tracking-wide">Recruiter</h3>
          <p class="text-slate-700 text-sm text-center font-semibold">I want to hire top talent and manage job postings.</p>
          
          <!-- Indicator -->
          <div class="absolute bottom-6 right-6 text-blue-700 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </div>
        </div>
      </div>

      <div class="pt-4">
        <button 
          @click="$router.push({ name: 'home' })"
          class="text-slate-400 hover:text-white transition-colors flex items-center gap-2 font-medium"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Cancel and return home
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();

const onClick = (type) => {
  if (type === 'candidate') {
    router.push('/candidate');
  } else if (type === 'recruiter') {
    router.push('/recruiter');
  }
};
</script>

<style scoped>
/* Translucent hover effect */
.bg-white\/50 {
  background-color: rgba(255, 255, 255, 0.5);
}
.bg-white\/80 {
  background-color: rgba(255, 255, 255, 0.8);
}
</style>

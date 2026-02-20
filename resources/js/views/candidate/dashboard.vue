<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 py-8 px-4">
    <div class="max-w-7xl mx-auto">
      
      <!-- Welcome Header -->
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">
          Welcome back, {{ userName }}! 👋
        </h1>
        <p class="text-slate-400 text-lg">
          Your AI-powered job search assistant is working for you
        </p>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Profile Completion Card -->
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700">
          <div class="flex justify-between items-start mb-4">
            <div>
              <p class="text-slate-400 text-sm">Profile Strength</p>
              <p class="text-3xl font-bold text-white mt-1">{{ profileCompletion }}%</p>
            </div>
            <div class="w-12 h-12 bg-blue-500/20 rounded-full flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
          </div>
          <div class="w-full bg-slate-700 rounded-full h-2">
            <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" :style="`width: ${profileCompletion}%`"></div>
          </div>
          <p class="text-slate-500 text-sm mt-3">
            Add {{ 100 - profileCompletion }}% more to unlock all features
          </p>
        </div>

        <!-- Skills Added Card -->
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700">
          <div class="flex justify-between items-start mb-4">
            <div>
              <p class="text-slate-400 text-sm">Skills Added</p>
              <p class="text-3xl font-bold text-white mt-1">{{ skillsCount }}</p>
            </div>
            <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center">
              <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
          <p class="text-green-400 text-sm">{{ skillsCount > 0 ? 'Great start!' : 'Add skills to get matched' }}</p>
          <button 
            @click="$router.push({ name: 'addSkills' })"
            class="mt-3 w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg text-sm font-medium transition"
          >
            + Add Skills
          </button>
        </div>

        <!-- Match Score Card -->
        <div class="bg-slate-800 rounded-xl p-6 border border-slate-700">
          <div class="flex justify-between items-start mb-4">
            <div>
              <p class="text-slate-400 text-sm">Average Match</p>
              <p class="text-3xl font-bold text-white mt-1">{{ avgMatchScore }}%</p>
            </div>
            <div class="w-12 h-12 bg-purple-500/20 rounded-full flex items-center justify-center">
              <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
          </div>
          <p class="text-slate-500 text-sm">
            {{ avgMatchScore > 0 ? 'You\'re matching well!' : 'Complete profile to see matches' }}
          </p>
        </div>
      </div>

      <!-- Main Content Area - Centered like Claude -->
      <div class="max-w-4xl mx-auto">
        
        <!-- Action Buttons -->
        <div class="flex gap-4 mb-6">
          <button 
            @click="showStats = !showStats"
            class="flex-1 bg-slate-800 hover:bg-slate-700 text-white py-3 rounded-lg font-medium transition border border-slate-600"
          >
            📊 {{ showStats ? 'Hide' : 'Show' }} Analytics
          </button>
          <button 
            class="flex-1 bg-slate-800 hover:bg-slate-700 text-white py-3 rounded-lg font-medium transition border border-slate-600"
          >
            🔍 Filter Jobs
          </button>
        </div>

        <!-- Stats Panel (Collapsible) -->
        <div v-if="showStats" class="bg-slate-800 rounded-xl p-6 border border-slate-700 mb-6">
          <h3 class="text-xl font-bold text-white mb-4">Market Insights for {{ formData.jobTitle || 'Your Role' }}</h3>
          
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-slate-900 rounded-lg p-4">
              <p class="text-slate-400 text-sm">Jobs Matched</p>
              <p class="text-2xl font-bold text-white mt-1">{{ jobsMatched }}</p>
            </div>
            <div class="bg-slate-900 rounded-lg p-4">
              <p class="text-slate-400 text-sm">Avg Salary</p>
              <p class="text-2xl font-bold text-white mt-1">{{ avgSalary }} TND</p>
            </div>
            <div class="bg-slate-900 rounded-lg p-4">
              <p class="text-slate-400 text-sm">Top Hiring Location</p>
              <p class="text-lg font-semibold text-white mt-1">{{ topLocation }}</p>
            </div>
            <div class="bg-slate-900 rounded-lg p-4">
              <p class="text-slate-400 text-sm">Most Demanded Skill</p>
              <p class="text-lg font-semibold text-white mt-1">{{ topSkill }}</p>
            </div>
          </div>

          <p class="text-slate-500 text-sm mt-4 text-center">
            💡 These insights are based on {{ jobsScraped }} jobs analyzed in real-time
          </p>
        </div>

        <!-- Jobs List / Empty State -->
        <div class="bg-slate-800 rounded-xl p-8 border border-slate-700 text-center">
          
          <!-- Empty State -->
          <div v-if="jobsMatched === 0">
            <div class="w-24 h-24 bg-slate-700 rounded-full mx-auto mb-6 flex items-center justify-center">
              <svg class="w-12 h-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>

            <h3 class="text-2xl font-bold text-white mb-3">
              No Jobs Yet
            </h3>
            
            <p class="text-slate-400 mb-2 max-w-md mx-auto">
              We're analyzing the market to find the best matches for you.
            </p>
            
            <p class="text-slate-500 text-sm mb-6">
              Add your skills to help our AI find jobs that perfectly match your profile.
            </p>

            <button 
              @click="$router.push({ name: 'addSkills' })"
              class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition"
            >
              + Add Skills Now
            </button>
          </div>

          <!-- Jobs List (when they exist) -->
          <div v-else>
            <!-- We'll add job cards here later -->
            <p class="text-white">{{ jobsMatched }} jobs matched to your profile!</p>
          </div>

        </div>

        <!-- Reassuring Message -->
        <div class="mt-6 bg-blue-500/10 border border-blue-500/30 rounded-lg p-4 text-center">
          <p class="text-blue-300 text-sm">
            ✨ Your profile is being analyzed 24/7. We'll notify you when perfect matches appear.
          </p>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

// Mock data (will be replaced with real API calls later)
const userName = ref('User');
const skillsCount = ref(2); // From your screenshot "2 added"
const showStats = ref(false);

// Profile completion calculation
const profileCompletion = computed(() => {
  // Basic info = 33%, Skills (2 added) = 20%, Resume = 0%
  return 40; // Matches your screenshot
});

// Placeholder stats (comment these out until job_offers table is ready)
const jobsMatched = ref(0);
const avgMatchScore = ref(0);
const avgSalary = ref('N/A');
const topLocation = ref('Tunis');
const topSkill = ref('Laravel');
const jobsScraped = ref(0);

// Form data from profile (will fetch from API later)
const formData = ref({
  jobTitle: 'Frontend Developer'
});

onMounted(() => {
  // TODO: Fetch user data from API
  // TODO: Fetch matched jobs from API
  // TODO: Fetch market stats from API
});
</script>
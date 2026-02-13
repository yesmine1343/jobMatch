<template>
  <section class="max-w-6xl mx-auto pt-20 pb-12 px-4">
    <!-- Hero Section - Always visible -->
    <div class="text-center space-y-6 mb-16">
      <h1 class="text-5xl font-bold text-sky-400">
        Welcome to JobMatch
      </h1>
      <br><br>
      <h2 class="text-2xl font-semibold text-white">
        The smarter way to match jobs & talents
      </h2>
      <br>
      <p class="text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed">
        AI-powered skill gap analysis shows you what to learn to unlock more opportunities.<br>
        Intelligent candidate matching algorithm to save recruiters hours of evaluation time. 
        
      </p>

      <!-- Get Started Button - Only show if dashboard not visible -->
      <div class="pt-6" v-if="!showDashboard">
        <button
          @click="handleGetStarted"
          class="px-10 py-4 bg-blue-600 text-white text-lg font-semibold rounded-lg
                 hover:bg-blue-700 transform hover:scale-105 transition-all duration-200
                 shadow-lg hover:shadow-xl"
        >
          Get Started →
        </button>
      </div>

      <p class="text-slate-400 text-sm pt-2">
        To personalize your experience and keep your data secure, you'll need an account.
      </p>
    </div>

    <!-- Dashboard Preview Section - Only show after "Get Started" is clicked -->
    <div v-if="showDashboard" class="max-w-5xl mx-auto">
      <div class="text-center mb-8">
        <h3 class="text-2xl font-bold text-white mb-2">
          Here's what your dashboard will look like
        </h3>
        <p class="text-slate-300">
          Click "Set Up Your Profile" below to continue
        </p>
      </div>
      
      <DashboardPreview @setup="handleSetupProfile" />
    </div>

    <!-- Auth Prompt Modal (shown when not logged in) -->
    <div
      v-if="showAuthPrompt"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
      @click="showAuthPrompt = false"
    >
      <div
        class="bg-white rounded-xl p-8 max-w-md mx-4 shadow-2xl"
        @click.stop
      >
        <h3 class="text-2xl font-bold text-slate-800 mb-4">
          You're almost there!
        </h3>
        
        <p class="text-slate-600 mb-6">
          Please login or create an account to continue.
        </p>

        <div class="flex gap-4">
          <button
            @click="$router.push({ name: 'login' })"
            class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg
                   hover:bg-blue-700 transition font-medium"
          >
            Login
          </button>
          
          <button
            @click="$router.push({ name: 'register' })"
            class="flex-1 px-6 py-3 bg-slate-200 text-slate-800 rounded-lg
                   hover:bg-slate-300 transition font-medium"
          >
            Sign Up
          </button>
        </div>

        <button
          @click="showAuthPrompt = false"
          class="w-full mt-4 text-slate-500 hover:text-slate-700 text-sm"
        >
          Cancel
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import DashboardPreview from '../components/DashboardPreview.vue'

const router = useRouter()
const showAuthPrompt = ref(false)
const showDashboard = ref(false)
const isAuthenticated = ref(false)

onMounted(() => {
  isAuthenticated.value = !!localStorage.getItem('token')
})

const handleGetStarted = () => {
  // Show the dashboard preview
  showDashboard.value = true
  
  // Smooth scroll to dashboard
  setTimeout(() => {
    const dashboardElement = document.querySelector('.max-w-5xl')
    if (dashboardElement) {
      dashboardElement.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }
  }, 100)
}

const handleSetupProfile = () => {
  if (!isAuthenticated.value) {
    showAuthPrompt.value = true
  } else {
    router.push({ name: 'RoleSelection' })
  }
}
</script>
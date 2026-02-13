<template>
  <section class="max-w-6xl mx-auto pt-20 pb-12 px-4">
    <div class="text-center mb-8">
      <h3 class="text-3xl font-bold text-white mb-2">
        Here's what your dashboard will look like
      </h3>
      <p class="text-slate-300 text-lg">
        Click "Set Up Your Profile" below to continue
      </p>
    </div>

    <!-- Your dashboard mockup/preview content here -->
    <div class="bg-slate-800 rounded-lg p-8 mb-8">
      <p class="text-white">Dashboard preview content goes here...</p>
      <!-- Add your charts, cards, etc -->
    </div>

    <!-- Set Up Profile Button -->
    <div class="text-center">
      <button
        @click="handleSetup"
        class="px-10 py-4 bg-green-600 text-white text-lg font-semibold rounded-lg
               hover:bg-green-700 transform hover:scale-105 transition-all duration-200
               shadow-lg hover:shadow-xl"
      >
        Set Up Your Profile →
      </button>
    </div>
  </section>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()
const handleSetup = () => {
    router.push({ name: 'RoleSelection' })
}
</script>

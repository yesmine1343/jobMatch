<template>
  <section class="max-w-6xl mx-auto pt-20 pb-16 px-4">
    <!-- Heading -->
    <div class="text-center mb-10">
      <h3 class="text-3xl font-bold text-white mb-3">
        Here's what your dashboard will look like
      </h3>
      <p class="text-slate-300 text-lg">
        Click "Set Up Your Profile" below to continue
      </p>
    </div>

    <!-- Dashboard Preview Card -->
    <div
      class="bg-slate-900/80 border border-slate-800 rounded-3xl shadow-2xl shadow-slate-900/60
             px-8 py-8 md:px-10 md:py-10 mb-10"
    >
      <!-- Top stats -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="bg-slate-800/80 rounded-2xl px-4 py-4 flex flex-col justify-between">
          <div class="text-slate-400 text-xs uppercase tracking-wide mb-1.5">
            Jobs Scraped
          </div>
          <div class="text-2xl font-semibold text-sky-400">
            2,847
          </div>
        </div>

        <div class="bg-slate-800/80 rounded-2xl px-4 py-4 flex flex-col justify-between">
          <div class="text-slate-400 text-xs uppercase tracking-wide mb-1.5">
            Avg Salary
          </div>
          <div class="text-2xl font-semibold text-sky-400">
            1500 TND
          </div>
        </div>

        <div class="bg-slate-800/80 rounded-2xl px-4 py-4 flex flex-col justify-between">
          <div class="text-slate-400 text-xs uppercase tracking-wide mb-1.5">
            Companies
          </div>
          <div class="text-2xl font-semibold text-sky-400">
            156
          </div>
        </div>

        <div class="bg-slate-800/80 rounded-2xl px-4 py-4 flex flex-col justify-between">
          <div class="text-slate-400 text-xs uppercase tracking-wide mb-1.5">
            Top Skills
          </div>
          <div class="text-2xl font-semibold text-sky-400">
            42
          </div>
        </div>
      </div>

      <!-- Simple bar chart preview -->
      <div class="bg-slate-800/80 rounded-2xl px-6 py-6 md:px-8 md:py-8">
        <div class="flex items-baseline justify-between mb-6">
          <div>
            <h4 class="text-xl md:text-2xl font-semibold text-white">
              Main Dashboard Overview
            </h4>
            <p class="text-slate-400 text-xs md:text-sm mt-1">
              Track real-time job market trends and salary insights across all scraped positions.
            </p>
          </div>
        </div>

        <div class="h-40 md:h-48 flex items-end justify-between gap-3">
          <div class="flex-1 flex flex-col justify-end">
            <div class="w-full bg-gradient-to-t from-sky-500 to-blue-400 rounded-t-xl h-16"></div>
          </div>
          <div class="flex-1 flex flex-col justify-end">
            <div class="w-full bg-gradient-to-t from-sky-500 to-blue-400 rounded-t-xl h-24"></div>
          </div>
          <div class="flex-1 flex flex-col justify-end">
            <div class="w-full bg-gradient-to-t from-sky-500 to-blue-400 rounded-t-xl h-32"></div>
          </div>
          <div class="flex-1 flex flex-col justify-end">
            <div class="w-full bg-gradient-to-t from-sky-500 to-blue-400 rounded-t-xl h-20"></div>
          </div>
          <div class="flex-1 flex flex-col justify-end">
            <div class="w-full bg-gradient-to-t from-sky-500 to-blue-400 rounded-t-xl h-36"></div>
          </div>
        </div>
      </div>
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

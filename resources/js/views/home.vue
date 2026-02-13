<template>
  <section class="max-w-6xl mx-auto pt-20 pb-12 px-4">
    <div class="text-center space-y-6">
      <h1 class="text-5xl font-bold text-sky-400">
        Welcome to JobMatch
      </h1>
      
      <h2 class="text-2xl font-semibold text-white">
        The smarter way to match jobs & talents
      </h2>

      <p class="text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed">
        AI-powered skill gap analysis shows you what to learn to unlock more opportunities.
        <br>
        Intelligent candidate matching algorithm to save recruiters hours of evaluation time.
      </p>

      <div class="pt-6">
        <button
          @click="$router.push({ name: 'DashboardPreview' })"
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
  </section>
</template>

<script setup>
</script>
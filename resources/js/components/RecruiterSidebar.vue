<template>
  <nav class="space-y-3">
    <router-link
      :to="{ name: 'CreateJob' }"
      class="block w-full rounded-xl bg-blue-600 px-6 py-4 text-white text-lg font-semibold hover:bg-blue-700 transition"
    >
      Create New Job →
    </router-link>

    <router-link
      :to="{ name: 'MatchScore' }"
      class="block w-full rounded-xl bg-slate-800/70 border border-slate-700 px-6 py-4 text-blue-200 text-lg font-semibold hover:bg-slate-700 transition"
    >
      Match Score Filter
    </router-link>

    <!-- Add more links later as routes exist -->
  </nav>
</template>
<script setup>
</script>
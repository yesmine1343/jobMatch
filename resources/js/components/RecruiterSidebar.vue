<template>
  <nav class="space-y-3">
    <router-link
      :to="{ name: 'JobOffer' }"
      class="block w-full rounded-xl bg-green-600 px-6 py-4 text-white text-lg font-semibold hover:bg-green-700 transition text-center"
    >
      Create new job offer →
    </router-link>

    <router-link
      :to="{ name: 'JobList' }"
      class="block w-full rounded-xl bg-blue-600 px-6 py-4 text-white text-lg font-semibold hover:bg-blue-700 transition"
    >
      Job Offers →
    </router-link>

    <router-link
      :to="{ name: 'applications' }"
      class="block w-full rounded-xl bg-slate-800/70 border border-slate-700 px-6 py-4 text-blue-200 text-lg font-semibold hover:bg-slate-700 transition"
    >
      View candidate applications →
    </router-link>

    <router-link
      :to="{ name: 'RoleSelection' }"
      class="block w-full rounded-xl bg-slate-800/70 border border-slate-700 px-6 py-4 text-blue-200 text-lg font-semibold hover:bg-slate-700 transition"
    >
      switch to candidate view →
    </router-link>

    <!-- Add more links later as routes exist -->
  </nav>
</template>
<script setup>
</script>
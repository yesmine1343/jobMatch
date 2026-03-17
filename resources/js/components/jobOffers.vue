<template>
	<div class="job-offers-list grid gap-4">
		<div v-for="job in jobs" :key="job.id" class="p-4 border border-blue-700 rounded-xl bg-slate-900 flex flex-col md:flex-row justify-between items-center">
			<div>
				<h3 class="text-lg font-bold text-white mb-1">{{ job.title }}</h3>
				<p class="text-slate-400 text-sm mb-1">📍 {{ job.location }} • {{ job.work_model }}</p>
				<p class="text-slate-400 text-sm mb-1">💰 {{ job.salary_min }} - {{ job.salary_max }} TND</p>
				<p class="text-slate-400 text-sm mb-1">Experience: {{ job.required_experience_level }}</p>
			</div>
			<div class="mt-2 md:mt-0 md:ml-6">
				<span class="px-4 py-2 rounded-lg font-bold text-lg bg-blue-700 text-white">{{ job.match_score ? job.match_score + '%' : '' }}</span>
			</div>
		</div>
		<div v-if="!jobs || jobs.length === 0" class="text-slate-400 text-center py-8">No job offers available.</div>
	</div>
</template>

<script setup>
defineProps({ jobs: { type: Array, required: true } });
</script>

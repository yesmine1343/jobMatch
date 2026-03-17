<template>
  <div class="mb-8">
    <h2 class="text-slate-200 text-2xl font-semibold mb-5">Role Basics</h2>
    <div class="mb-6">
      <label class="block text-slate-200 text-base font-medium mb-2.5">Job Title</label>
      <input 
        v-model="formData.jobTitle" 
        type="text" 
        placeholder="e.g., Senior Frontend Developer"
        class="w-full bg-slate-900 border border-slate-600 rounded-xl px-5 py-3.5 text-white text-base focus:outline-none focus:border-blue-500 placeholder-slate-500"
      />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
      <div>
        <label class="block text-slate-200 text-base font-medium mb-2.5">Department</label>
        <div class="relative">
          <select 
            v-model="formData.department" 
            class="w-full bg-slate-900 border border-slate-600 rounded-xl px-5 py-3.5 text-white text-base focus:outline-none focus:border-blue-500 cursor-pointer appearance-none"
          >
            <option value="">Select department...</option>
            <option value="engineering">Engineering</option>
            <option value="design">Design</option>
            <option value="product">Product</option>
            <option value="marketing">Marketing</option>
            <option value="sales">Sales</option>
          </select>
          <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </div>
      <div>
        <label class="block text-slate-200 text-base font-medium mb-2.5">Location</label>
        <input 
          v-model="formData.location" 
          type="text" 
          placeholder="City, Country or Remote"
          class="w-full bg-slate-900 border border-slate-600 rounded-xl px-5 py-3.5 text-white text-base focus:outline-none focus:border-blue-500 placeholder-slate-500"
        />
      </div>
    </div>
    <slot />
  </div>
</template>

<script setup>
const props = defineProps({
  formData: Object
});
</script>

<template>
  <div class="card p-6 bg-slate-800 rounded-xl shadow-lg border border-slate-700 max-w-sm mx-auto mt-10">
    <div class="space-y-4">
      <div class="relative">
        <img src="https://placehold.co/400x400/1e293b/60a5fa?text=Employer+Avatar" alt="Employer Profile" class="w-full h-48 object-cover rounded-lg border-2 border-slate-700">
        <div class="absolute -bottom-4 right-4 bg-blue-600 p-2 rounded-full border-2 border-slate-800">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
        </div>
      </div>

      <div class="text-center pt-2">
        <h1 class="text-2xl font-bold text-white tracking-tight">John Doe</h1>
        <p class="text-blue-400 font-medium tracking-wide uppercase text-xs">CEO & Founder, JobMatch</p>
      </div>

      <div class="bg-slate-900/50 p-4 rounded-lg border border-slate-700/50">
        <p class="text-slate-400 text-sm italic text-center leading-relaxed">
          "Connecting the best talent with world-class opportunities."
        </p>
      </div>

      <div class="flex justify-center gap-4 text-slate-400">
        <a href="#" class="hover:text-blue-400 transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z"/></svg>
        </a>
        <a href="#" class="hover:text-sky-400 transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
        </a>
      </div>

      <button class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-lg transition-all duration-200 shadow-lg shadow-blue-500/20 active:scale-[0.98]">
        Contact Representative
      </button>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>
.card {
  transition: transform 0.3s ease;
}
.card:hover {
  transform: translateY(-5px);
}
</style>
